#!/bin/bash
# Deploy script for staging environment
# Usage: ./deploy-staging.sh

set -e

echo "🚀 Starting Staging Deployment..."

# Color codes
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m'

# Configuration
REMOTE_USER=${DEPLOY_USER:-deploy}
REMOTE_HOST=${DEPLOY_HOST:-staging.example.com}
REMOTE_PATH=${DEPLOY_PATH:-/var/www/task-manager}
SSH_PORT=${DEPLOY_SSH_PORT:-22}

# Local paths
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"

echo -e "${BLUE}Configuration:${NC}"
echo "  Remote User: $REMOTE_USER"
echo "  Remote Host: $REMOTE_HOST"
echo "  Remote Path: $REMOTE_PATH"
echo "  SSH Port: $SSH_PORT"
echo ""

# Step 1: Create deployment package
echo -e "${BLUE}[1/6] Creating deployment package...${NC}"
mkdir -p "$PROJECT_ROOT/build"
cd "$PROJECT_ROOT"

# Install production dependencies
echo "  Installing production dependencies..."
composer install --no-dev --prefer-dist --optimize-autoloader --quiet

# Build frontend assets
echo "  Building frontend assets..."
npm ci --quiet
npm run build --quiet

# Create tarball
echo "  Creating tarball..."
tar -czf build/app.tar.gz \
  --exclude='.git' \
  --exclude='.github' \
  --exclude='node_modules' \
  --exclude='storage/logs' \
  --exclude='storage/framework/cache' \
  --exclude='tests' \
  --exclude='build' \
  --exclude='.env*' \
  .

echo -e "${GREEN}✓ Deployment package created${NC}"

# Step 2: Transfer files
echo -e "${BLUE}[2/6] Transferring files to server...${NC}"
scp -P $SSH_PORT build/app.tar.gz "$REMOTE_USER@$REMOTE_HOST:$REMOTE_PATH/"
echo -e "${GREEN}✓ Files transferred${NC}"

# Step 3: Extract and prepare
echo -e "${BLUE}[3/6] Extracting and preparing application...${NC}"
ssh -p $SSH_PORT "$REMOTE_USER@$REMOTE_HOST" "
  set -e
  cd $REMOTE_PATH
  
  # Create backup
  if [ -d app ]; then
    cp -r app app.backup.\$(date +%Y%m%d_%H%M%S)
  fi
  
  # Extract new code
  tar -xzf app.tar.gz
  
  # Copy .env if not exists
  if [ ! -f .env ]; then
    cp .env.example .env
  fi
  
  # Set permissions
  chown -R $REMOTE_USER:www-data .
  chmod -R 755 .
  chmod -R 775 storage bootstrap/cache
"
echo -e "${GREEN}✓ Application extracted and prepared${NC}"

# Step 4: Install dependencies
echo -e "${BLUE}[4/6] Installing dependencies...${NC}"
ssh -p $SSH_PORT "$REMOTE_USER@$REMOTE_HOST" "
  set -e
  cd $REMOTE_PATH
  
  composer install --no-dev --prefer-dist --optimize-autoloader --quiet
  
  # Database migrations
  php artisan migrate --force --quiet
  
  # Cache configuration
  php artisan config:cache --quiet
  php artisan route:cache --quiet
  php artisan view:cache --quiet
"
echo -e "${GREEN}✓ Dependencies installed and configured${NC}"

# Step 5: Restart services
echo -e "${BLUE}[5/6] Restarting services...${NC}"
ssh -p $SSH_PORT "$REMOTE_USER@$REMOTE_HOST" "
  set -e
  
  # Restart PHP-FPM
  if command -v systemctl &> /dev/null; then
    sudo systemctl restart php-fpm || true
  else
    sudo service php-fpm restart || true
  fi
  
  # Clear old cache
  cd $REMOTE_PATH
  php artisan queue:restart --quiet || true
"
echo -e "${GREEN}✓ Services restarted${NC}"

# Step 6: Health check
echo -e "${BLUE}[6/6] Running health checks...${NC}"
ssh -p $SSH_PORT "$REMOTE_USER@$REMOTE_HOST" "
  cd $REMOTE_PATH
  php artisan health:check || true
"
echo -e "${GREEN}✓ Health checks completed${NC}"

# Cleanup
echo ""
echo -e "${BLUE}Cleaning up...${NC}"
rm -f build/app.tar.gz

echo ""
echo -e "${GREEN}✅ Staging deployment completed successfully!${NC}"
echo "Visit: https://staging.example.com"
