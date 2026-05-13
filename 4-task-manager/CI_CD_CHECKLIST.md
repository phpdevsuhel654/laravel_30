# CI/CD Setup Checklist

Complete this checklist to fully enable CI/CD for your Laravel application.

## Phase 1: Preparation ✓

- [ ] Fork/clone repository to GitHub
- [ ] Ensure all code is committed to git
- [ ] Latest changes pushed to GitHub
- [ ] Read CI_CD_GUIDE.md and QUICK_START_CI_CD.md

## Phase 2: Local Setup ✓

### Testing
- [ ] Run tests locally: `php artisan test`
- [ ] Tests pass without errors
- [ ] All test files in `tests/` directory
- [ ] Test database can be created

### Code Quality
- [ ] Run Pint: `php artisan pint --test`
- [ ] Run PHPStan: `./vendor/bin/phpstan analyse` (if configured)
- [ ] No critical code style issues

### Dependencies
- [ ] `composer install` works
- [ ] `npm install` works
- [ ] `npm run build` completes successfully

## Phase 3: GitHub Configuration ✓

### Repository Settings
- [ ] Repository visibility set to appropriate level
- [ ] Description updated
- [ ] README.md has badge placeholders
- [ ] .gitignore includes:
  - [ ] `vendor/`
  - [ ] `node_modules/`
  - [ ] `.env`
  - [ ] `storage/logs/`

### Branch Protection Rules
- [ ] Go to Settings → Branches
- [ ] Create rule for `main` branch:
  - [ ] Require status checks to pass
  - [ ] Require pull request reviews (1-2 required)
  - [ ] Require review from code owners
  - [ ] Restrict who can push
  - [ ] Automatically delete head branches

- [ ] Create rule for `develop` branch:
  - [ ] Require status checks to pass
  - [ ] Require pull request reviews (optional)
  - [ ] Automatically delete head branches

## Phase 4: Secrets Configuration ✓

### GitHub Actions Secrets
Go to Settings → Secrets and variables → Actions

#### Deployment Secrets
- [ ] **DEPLOY_USER**: SSH username (e.g., `deploy`)
- [ ] **DEPLOY_HOST**: Server hostname (e.g., `staging.example.com`)
- [ ] **DEPLOY_PATH**: Deployment path (e.g., `/var/www/task-manager`)
- [ ] **DEPLOY_SSH_KEY**: Private SSH key (full content)
- [ ] **DEPLOY_SSH_PORT**: SSH port (default: `22`)

#### Notification Secrets
- [ ] **SLACK_WEBHOOK**: Slack webhook URL (optional)

#### Database & Services
- [ ] **DB_PASSWORD**: Database password (if needed)
- [ ] **REDIS_PASSWORD**: Redis password (if needed)
- [ ] **MAIL_PASSWORD**: Email password (if needed)

#### Optional Services
- [ ] **SENTRY_LARAVEL_DSN**: Error tracking (optional)
- [ ] **AWS_ACCESS_KEY_ID**: AWS key (if using S3)
- [ ] **AWS_SECRET_ACCESS_KEY**: AWS secret
- [ ] **PUSHER_APP_KEY**: Pusher credentials (if using)

## Phase 5: Server Setup ✓

### Staging Server
- [ ] SSH access configured
- [ ] PHP 8.3+ installed
- [ ] MySQL/PostgreSQL installed
- [ ] Node.js 18+ installed
- [ ] Composer installed
- [ ] NPM installed
- [ ] Web server (Apache/Nginx) configured
- [ ] SSL certificate installed
- [ ] Firewall allows SSH (port 22 by default)

### User Permissions
- [ ] Create `deploy` user: `sudo useradd -m deploy`
- [ ] Add public key to `~/.ssh/authorized_keys`
- [ ] User can create directories in deployment path
- [ ] User can restart PHP-FPM service
- [ ] User can write to storage/logs

### SSH Key Setup
- [ ] Generate SSH key pair locally (if needed)
  ```bash
  ssh-keygen -t rsa -b 4096 -f ~/.ssh/deploy_key -N ""
  ```
- [ ] Add public key to server's `authorized_keys`
- [ ] Test connection: `ssh -i deploy_key deploy@host`
- [ ] Private key added to GitHub Secrets as `DEPLOY_SSH_KEY`

### Web Server Configuration
- [ ] Laravel app root points to `public/` directory
- [ ] `.htaccess` or Nginx rewrite rules configured
- [ ] Laravel storage paths writable
- [ ] Cache directory writable
- [ ] Log file creation allowed

## Phase 6: Workflow Files ✓

All GitHub Actions workflow files should exist:

- [ ] `.github/workflows/tests.yml` - Testing
- [ ] `.github/workflows/code-quality.yml` - Linting & analysis
- [ ] `.github/workflows/security.yml` - Security scanning
- [ ] `.github/workflows/deploy.yml` - Production deployment

Check syntax:
- [ ] All YAML files are valid (no syntax errors)
- [ ] File paths are correct
- [ ] Action versions are compatible with GitHub Actions

## Phase 7: Configuration Files ✓

Environment configuration files:

- [ ] `.env.example` - Default configuration
- [ ] `.env.staging` - Staging-specific config
- [ ] `.env.production` - Production-specific config
- [ ] Both contain proper database credentials placeholders

Deployment scripts:

- [ ] `deploy-staging.sh` - Manual deployment script
- [ ] Script is executable: `chmod +x deploy-staging.sh`
- [ ] Script has proper error handling
- [ ] SSH configuration matches GitHub Secrets

## Phase 8: Testing ✓

### First Test Run
- [ ] Push a test commit to develop branch
- [ ] Go to Actions tab
- [ ] Watch "Tests" workflow run
- [ ] Verify all tests pass
- [ ] Check coverage reports generated

### Code Quality Check
- [ ] "Code Quality" workflow runs
- [ ] Pint check completes
- [ ] No critical style issues
- [ ] Static analysis completes

### Security Scan
- [ ] "Security" workflow can be manually triggered
- [ ] Dependency check completes
- [ ] No critical vulnerabilities found

## Phase 9: First Deployment ✓

### Manual Staging Deployment
- [ ] Run: `./deploy-staging.sh`
- [ ] Deployment completes without errors
- [ ] Application accessible at staging URL
- [ ] Database migrations applied
- [ ] Logs show no errors

### Automated Deployment Test
- [ ] Create PR to main branch
- [ ] All checks pass
- [ ] Merge PR to main
- [ ] Deployment workflow triggers
- [ ] Staging deployment completes automatically

## Phase 10: Notifications ✓

### GitHub Notifications
- [ ] Email notifications configured
- [ ] Receive failure notifications

### Slack Integration (Optional)
- [ ] Slack workspace prepared
- [ ] Webhook URL obtained
- [ ] Added to GitHub Secrets as `SLACK_WEBHOOK`
- [ ] Test message received
- [ ] Deployment notifications working

### Email Notifications
- [ ] Configured email recipient
- [ ] Test email received
- [ ] Failure alerts working

## Phase 11: Monitoring & Documentation ✓

### Dashboard Setup
- [ ] GitHub Actions dashboard bookmarked
- [ ] Status badges added to README.md
- [ ] README.md shows build status

### Documentation
- [ ] CI_CD_GUIDE.md reviewed
- [ ] QUICK_START_CI_CD.md available to team
- [ ] WORKFLOWS_REFERENCE.md ready for reference
- [ ] Team aware of deployment procedures
- [ ] Rollback procedures documented

### Error Tracking (Optional)
- [ ] Sentry account created (if using)
- [ ] DSN obtained and added to secrets
- [ ] Error tracking working in production

## Phase 12: Production Readiness ✓

### Final Checks
- [ ] Production server identical to staging
- [ ] Production database backed up
- [ ] Production SSL certificate current
- [ ] Production firewall allows necessary ports
- [ ] Production backups automated

### Monitoring
- [ ] Application monitoring set up
- [ ] Log aggregation configured
- [ ] Performance monitoring enabled
- [ ] Alert thresholds set
- [ ] On-call schedule published

### Documentation
- [ ] Deployment runbook created
- [ ] Rollback procedure documented
- [ ] Team trained on deployment process
- [ ] Emergency contacts listed
- [ ] Incident response plan ready

## Phase 13: Ongoing Maintenance ✓

### Regular Tasks
- [ ] Weekly: Review failed workflows
- [ ] Monthly: Security audit of dependencies
- [ ] Monthly: Update GitHub Actions
- [ ] Quarterly: Review and rotate SSH keys
- [ ] Quarterly: Performance optimization

### Monitoring
- [ ] Track deployment frequency
- [ ] Monitor deployment duration
- [ ] Track rollback frequency
- [ ] Monitor test execution time
- [ ] Track code coverage trends

### Team Communication
- [ ] Document any process changes
- [ ] Share learnings with team
- [ ] Update documentation as needed
- [ ] Review metrics with team
- [ ] Plan improvements for next quarter

## Verification Commands

Test everything is working:

```bash
# Local tests
php artisan test

# Code quality
php artisan pint --test

# SSH connection
ssh -i ~/.ssh/deploy_key deploy@staging.example.com "echo 'SSH working!'"

# Manual deployment
./deploy-staging.sh

# Check GitHub Actions status
gh run list --workflow=tests.yml

# View workflow details
gh run view [RUN_ID]
```

## Rollback Procedure

If something goes wrong:

```bash
# On deployment server
cd /var/www/task-manager

# List backups
ls -la app.backup.*

# Restore backup
cp -r app app.failed
cp -r app.backup.YYYYMMDD_HHMMSS app

# Restart service
systemctl restart php-fpm
```

## Troubleshooting Quick Links

If you encounter issues:

1. Check GitHub Actions logs: Actions → Workflow → Click failed run
2. View server logs: `ssh deploy@host "tail -f /var/log/laravel.log"`
3. Test SSH: `ssh -v -i deploy_key deploy@host`
4. Test database: `mysql -h host -u user -p database`
5. Check disk: `ssh deploy@host "df -h"`

## Success Indicators

You'll know CI/CD is working when:

✅ Push to develop → Tests run automatically
✅ All tests pass → Green checkmark on PR
✅ PR merged to main → Staging deployment starts
✅ Deployment completes → Application updated
✅ Failure occurs → Slack notification received
✅ Team member sees status badge → Shows current status

## Final Verification

Once everything is set up:

1. [ ] Create test PR to main
2. [ ] Verify all checks pass
3. [ ] Merge PR
4. [ ] Watch deployment in Actions tab
5. [ ] Confirm staging app updated
6. [ ] Check Slack for notification

---

**Congratulations! Your CI/CD pipeline is now fully configured and operational! 🎉**

For questions or issues, refer to:
- CI_CD_GUIDE.md (full documentation)
- QUICK_START_CI_CD.md (quick reference)
- WORKFLOWS_REFERENCE.md (workflow details)
