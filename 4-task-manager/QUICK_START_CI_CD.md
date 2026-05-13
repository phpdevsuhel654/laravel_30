# Quick Start Guide - CI/CD Setup

## 🚀 Getting Started in 5 Minutes

### Step 1: Push to GitHub

```bash
git init
git add .
git commit -m "Initial commit with CI/CD"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/task-manager.git
git push -u origin main
```

### Step 2: Configure GitHub Secrets

1. Go to your repository on GitHub
2. Settings → Secrets and variables → Actions
3. Add these secrets:

| Secret | Value | Example |
|--------|-------|---------|
| `DEPLOY_USER` | SSH username | `deploy` |
| `DEPLOY_HOST` | Server hostname | `staging.example.com` |
| `DEPLOY_PATH` | Deployment path | `/var/www/task-manager` |
| `DEPLOY_SSH_KEY` | Private SSH key | (contents of `~/.ssh/id_rsa`) |
| `DEPLOY_SSH_PORT` | SSH port | `22` |
| `SLACK_WEBHOOK` | Slack webhook URL | `https://hooks.slack.com/...` |

### Step 3: Watch Your First Deployment

1. Go to Actions tab
2. Watch tests run automatically
3. See deployment status in real-time

## 🔄 Workflows Overview

```
┌─────────────────────────────────────────┐
│       Your Push to GitHub               │
└────────────────┬────────────────────────┘
                 │
        ┌────────┴────────┐
        │                 │
   ┌────v────┐    ┌──────v──────┐
   │  Tests  │    │ Code Quality │
   └────┬────┘    └──────┬──────┘
        │                 │
        └────────┬────────┘
                 │
           ┌─────v─────┐
           │ All Green?│
           └─────┬─────┘
                 │
        ┌────────┴────────────┐
        │                     │
    ┌───v────┐         ┌──────v──────┐
    │  FAIL  │         │Deploy Staging│
    │  ❌    │         │  ✅          │
    └────────┘         └──────────────┘
```

## 📋 Workflow Files

| File | Purpose | Trigger |
|------|---------|---------|
| `tests.yml` | Run tests | Every push/PR |
| `code-quality.yml` | Lint & analyze | Every push/PR |
| `security.yml` | Security scan | Daily + on changes |
| `deploy.yml` | Production deploy | Push to main |

## 🛠️ Manual Commands

### Run Tests Locally
```bash
# All tests
php artisan test

# With coverage
php artisan test --coverage

# Specific file
php artisan test tests/Feature/TaskControllerTest.php
```

### Deploy to Staging (Manual)
```bash
chmod +x deploy-staging.sh
./deploy-staging.sh
```

### Check Code Quality
```bash
php artisan pint --test
./vendor/bin/phpstan analyse
```

## 🔒 Setting Up SSH Access

### Generate SSH Key (if needed)
```bash
ssh-keygen -t rsa -b 4096 -f deploy_key -N ""
```

### Add Public Key to Server
```bash
# On your deployment server
cat ~/.ssh/authorized_keys

# Add the public key from deploy_key.pub
ssh-copy-id -i deploy_key.pub deploy@staging.example.com
```

### Add Private Key to GitHub Secrets
```bash
# Copy the private key content
cat deploy_key

# Paste into DEPLOY_SSH_KEY secret
```

## 📊 Monitoring

### View Workflow Status
- GitHub Actions tab shows all runs
- Click on any workflow to see details
- Red = failed, Green = passed

### Get Notifications
- GitHub: Default email notifications
- Slack: Add webhook URL to secrets
- Email: Configure in Actions settings

## 🐛 Common Issues & Fixes

### Tests Failing
```bash
# Run locally to debug
php artisan test

# Check PHP version
php -v

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Deployment Stuck
```bash
# Check SSH access
ssh -p 22 deploy@staging.example.com

# Check disk space
df -h

# Check services
systemctl status php-fpm
```

### Secrets Not Working
- Verify secret names match workflow
- Check for typos in names
- Regenerate if needed
- Wait a few minutes for GitHub to update

## ✅ Success Checklist

- [ ] Repository on GitHub
- [ ] GitHub Secrets configured
- [ ] SSH access verified
- [ ] First test workflow passed
- [ ] Deployment completed
- [ ] Application running
- [ ] Slack notifications working

## 📚 Next Steps

1. **Configure Protected Branches**
   - Settings → Branches
   - Add rule for `main`
   - Require status checks to pass

2. **Set Up Error Tracking**
   - Add Sentry DSN to secrets
   - Monitor production errors

3. **Add More Tests**
   - Feature tests
   - API tests
   - Performance tests

4. **Optimize Performance**
   - Enable caching
   - Parallel testing
   - Multi-stage builds

## 📞 Support

Need help? Check:
1. [CI_CD_GUIDE.md](CI_CD_GUIDE.md) - Full documentation
2. GitHub Actions Logs - Detailed error messages
3. Server logs - `/var/log/laravel.log`
4. Laravel Documentation - https://laravel.com/docs

## 🎯 Key Files

```
.github/workflows/
├── tests.yml                 # Test suite
├── code-quality.yml         # Linting & analysis
├── security.yml             # Security scanning
└── deploy.yml               # Production deploy

.env.staging                 # Staging config
.env.production              # Production config

deploy-staging.sh            # Manual deploy script
CI_CD_GUIDE.md              # Full documentation
QUICK_START.md              # This file
```

---

**Ready to deploy? Push your code and watch the magic happen! 🚀**
