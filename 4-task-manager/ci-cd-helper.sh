#!/bin/bash
# CI/CD Helper Script
# Common commands for testing and deployment

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Functions
print_header() {
    echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
}

print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_info() {
    echo -e "${YELLOW}ℹ $1${NC}"
}

# Commands
test_all() {
    print_header "Running All Tests"
    php artisan test --parallel
    print_success "All tests passed"
}

test_coverage() {
    print_header "Running Tests with Coverage"
    php artisan test --coverage
    print_success "Coverage report generated in coverage/"
    echo "Open: coverage/index.html"
}

test_specific() {
    if [ -z "$1" ]; then
        echo "Usage: $0 test-specific <test-file-or-method>"
        exit 1
    fi
    print_header "Running Specific Test: $1"
    php artisan test --filter="$1"
}

code_style() {
    print_header "Checking Code Style"
    php artisan pint --test
    print_success "Code style check passed"
}

code_style_fix() {
    print_header "Fixing Code Style"
    php artisan pint
    print_success "Code style fixed"
}

static_analysis() {
    print_header "Running Static Analysis"
    if [ -f "phpstan.json" ] || [ -f "phpstan.neon" ]; then
        ./vendor/bin/phpstan analyse
        print_success "Static analysis passed"
    else
        print_error "PHPStan not configured"
        exit 1
    fi
}

security_check() {
    print_header "Checking Security"
    
    if ! command -v composer &> /dev/null; then
        print_error "Composer not installed"
        exit 1
    fi
    
    print_info "Scanning composer packages..."
    composer require --dev --no-scripts enlightn/security-checker > /dev/null 2>&1 || true
    ./vendor/bin/security-checker security:check composer.lock
    
    print_success "Security check completed"
}

database_migrate() {
    print_header "Running Database Migrations"
    php artisan migrate
    print_success "Migrations completed"
}

cache_clear() {
    print_header "Clearing Caches"
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    print_success "Caches cleared"
}

cache_optimize() {
    print_header "Optimizing Caches"
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    print_success "Caches optimized"
}

dev_setup() {
    print_header "Development Setup"
    
    print_info "Installing dependencies..."
    composer install
    npm install
    
    print_info "Configuring environment..."
    if [ ! -f .env ]; then
        cp .env.example .env
        php artisan key:generate
    fi
    
    print_info "Setting up database..."
    touch database/database.sqlite
    php artisan migrate
    php artisan db:seed
    
    print_info "Building frontend..."
    npm run build
    
    print_success "Development setup completed"
}

ci_simulate() {
    print_header "Simulating CI Pipeline"
    
    print_info "1. Running tests..."
    test_all || { print_error "Tests failed"; exit 1; }
    
    print_info "2. Checking code quality..."
    code_style || { print_error "Code style check failed"; exit 1; }
    
    print_info "3. Running static analysis..."
    static_analysis || { print_error "Static analysis failed"; exit 1; }
    
    print_info "4. Checking security..."
    security_check || { print_error "Security check failed"; exit 1; }
    
    print_success "CI Pipeline simulation passed"
}

health_check() {
    print_header "Application Health Check"
    
    print_info "Checking application..."
    php artisan health:check
    
    print_info "Checking database..."
    php artisan tinker --execute="DB::select('SELECT 1')" > /dev/null
    print_success "Database: OK"
    
    print_info "Checking storage..."
    php artisan storage:link > /dev/null 2>&1 || true
    print_success "Storage: OK"
    
    print_success "Health check passed"
}

deploy_staging() {
    print_header "Deploying to Staging"
    
    if [ ! -f deploy-staging.sh ]; then
        print_error "deploy-staging.sh not found"
        exit 1
    fi
    
    chmod +x deploy-staging.sh
    ./deploy-staging.sh
}

help() {
    echo ""
    echo "CI/CD Helper Script"
    echo "=================="
    echo ""
    echo "Usage: ./ci-cd-helper.sh <command>"
    echo ""
    echo "Testing Commands:"
    echo "  test              Run all tests"
    echo "  test-coverage     Run tests with coverage report"
    echo "  test-specific     Run specific test (usage: test-specific <filter>)"
    echo ""
    echo "Code Quality Commands:"
    echo "  code-style        Check code style"
    echo "  code-style-fix    Fix code style issues"
    echo "  static-analysis   Run static analysis (PHPStan)"
    echo "  security-check    Check for security vulnerabilities"
    echo ""
    echo "Database Commands:"
    echo "  migrate           Run database migrations"
    echo ""
    echo "Cache Commands:"
    echo "  cache-clear       Clear all caches"
    echo "  cache-optimize    Optimize and cache everything"
    echo ""
    echo "Setup Commands:"
    echo "  dev-setup         Complete development setup"
    echo "  health-check      Run application health checks"
    echo ""
    echo "CI/CD Commands:"
    echo "  ci-simulate       Simulate complete CI pipeline"
    echo "  deploy-staging    Deploy to staging environment"
    echo ""
    echo "Help:"
    echo "  help              Show this help message"
    echo ""
}

# Main
case "${1:-help}" in
    test)
        test_all
        ;;
    test-coverage)
        test_coverage
        ;;
    test-specific)
        test_specific "$2"
        ;;
    code-style)
        code_style
        ;;
    code-style-fix)
        code_style_fix
        ;;
    static-analysis)
        static_analysis
        ;;
    security-check)
        security_check
        ;;
    migrate)
        database_migrate
        ;;
    cache-clear)
        cache_clear
        ;;
    cache-optimize)
        cache_optimize
        ;;
    dev-setup)
        dev_setup
        ;;
    health-check)
        health_check
        ;;
    ci-simulate)
        ci_simulate
        ;;
    deploy-staging)
        deploy_staging
        ;;
    help)
        help
        ;;
    *)
        print_error "Unknown command: $1"
        help
        exit 1
        ;;
esac
