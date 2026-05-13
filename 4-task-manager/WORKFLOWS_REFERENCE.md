# GitHub Actions CI/CD Workflows

## Adding Status Badges to README

Add these badges to show CI/CD status in your project README.md:

### Markdown Code

```markdown
## CI/CD Status

[![Tests](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/tests.yml)
[![Code Quality](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/code-quality.yml/badge.svg?branch=main)](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/code-quality.yml)
[![Security](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/security.yml/badge.svg?branch=main)](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/security.yml)
[![Deploy](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/deploy.yml/badge.svg?branch=main)](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/deploy.yml)

[![Codecov](https://codecov.io/gh/YOUR_USERNAME/REPO_NAME/branch/main/graph/badge.svg)](https://codecov.io/gh/YOUR_USERNAME/REPO_NAME)
```

Replace `YOUR_USERNAME` and `REPO_NAME` with actual values.

## Workflow Configuration

### 1. Tests Workflow (`tests.yml`)

**When it runs:**
- Every push to `main` or `develop`
- Every pull request to `main` or `develop`

**What it does:**
- ✅ Installs PHP 8.3 & dependencies
- ✅ Runs database migrations
- ✅ Executes test suite
- ✅ Generates coverage reports
- ✅ Uploads to Codecov

**Jobs:**
```yaml
- Setup PHP environment
- Install Composer packages
- Create test database
- Run migrations
- Execute tests with coverage
```

**Artifacts:**
- `coverage/` - HTML coverage reports
- Test results visible in GitHub UI

### 2. Code Quality Workflow (`code-quality.yml`)

**When it runs:**
- Every push to `main` or `develop`
- Every pull request

**What it does:**
- ✅ Laravel Pint (code formatting)
- ✅ PHPStan (static analysis)
- ✅ Security checker
- ✅ Config file linting

**Failure Behavior:**
- Warnings don't block deployment
- Issues created for failures

### 3. Security Workflow (`security.yml`)

**When it runs:**
- Daily at 2 AM UTC
- On changes to `composer.lock` or `package-lock.json`
- Manual trigger

**What it does:**
- ✅ Composer security audit
- ✅ NPM vulnerability check
- ✅ Trivy filesystem scan
- ✅ Creates GitHub issues for found vulnerabilities

**Notifications:**
- GitHub security tab updated
- Issues created for vulnerabilities

### 4. Deploy Workflow (`deploy.yml`)

**When it runs:**
- Push to `main` branch (automatic)
- Manual trigger via `workflow_dispatch`

**Deployment Steps:**
```
1. Build production dependencies
2. Compile frontend assets
3. Create deployment package
4. Transfer to server via SCP
5. Extract and prepare
6. Run migrations
7. Cache Laravel configs
8. Restart PHP-FPM
9. Run health checks
10. Send notifications
```

**Environments:**
- **Staging**: Auto-deploy from `main`
- **Production**: Manual trigger only

## Required GitHub Secrets

Add to: Settings → Secrets and variables → Actions

### Deployment Secrets
```yaml
DEPLOY_USER: "deploy"                          # SSH user
DEPLOY_HOST: "staging.example.com"             # Server hostname
DEPLOY_PATH: "/var/www/task-manager"           # Deployment path
DEPLOY_SSH_KEY: |                              # Private SSH key
  -----BEGIN RSA PRIVATE KEY-----
  [key content]
  -----END RSA PRIVATE KEY-----
DEPLOY_SSH_PORT: "22"                          # SSH port (optional)
```

### Notification Secrets
```yaml
SLACK_WEBHOOK: "https://hooks.slack.com/..."   # Slack webhook
```

### Database & Services
```yaml
DB_PASSWORD: "your-secure-password"            # Database password
REDIS_PASSWORD: "your-redis-password"          # Redis password
MAIL_PASSWORD: "your-email-password"           # Email service
```

### Optional Integration Secrets
```yaml
SENTRY_LARAVEL_DSN: "https://..."              # Error tracking
AWS_SECRET_ACCESS_KEY: "your-aws-key"          # AWS credentials
PUSHER_APP_KEY: "your-pusher-key"              # Real-time features
```

## Setting Up Protected Branches

### For `main` Branch

1. Go to Settings → Branches
2. Click "Add rule"
3. Branch name pattern: `main`
4. Enable:
   - ✅ Require status checks to pass before merging
   - ✅ Require code reviews before merging
   - ✅ Require review from code owners
   - ✅ Restrict who can push to matching branches

### Required Status Checks

- ✅ Tests
- ✅ Code Quality

## Monitoring Workflows

### GitHub Actions Dashboard

1. Click "Actions" tab in repository
2. View all workflow runs
3. Click on any run for details

### Workflow Logs

Each job shows:
- ✅ Step-by-step execution
- 📝 Full command output
- ⏱️ Timing information
- 🔴 Error details if failed

### Getting Notifications

**GitHub Built-in:**
- Settings → Notifications
- Receive email for workflow failures

**Slack Integration:**
- Add `SLACK_WEBHOOK` secret
- Automatic Slack messages on deployment

**Email:**
- Can be configured per workflow

## Manual Deployment

### Via GitHub UI

1. Go to Actions tab
2. Click "Deploy to Production"
3. Click "Run workflow"
4. Select environment (staging/production)
5. Click "Run workflow"

### Via Command Line

```bash
# Requires GitHub CLI
gh workflow run deploy.yml -f environment=production
```

### Via Shell Script

```bash
chmod +x deploy-staging.sh
./deploy-staging.sh
```

## Troubleshooting

### Workflow Not Triggering

**Issue:** Workflow doesn't run on push

**Solutions:**
- Check branch name in workflow (main vs master)
- Verify file path is `.github/workflows/`
- Check file syntax (YAML)
- Try manual trigger in Actions tab

### Tests Failing in CI

**Issue:** Tests pass locally but fail in CI

**Debugging:**
1. Download logs from failed run
2. Check environment differences
3. Verify database is migrated
4. Check PHP extensions installed
5. Look for timezone/locale issues

### Deployment Stuck

**Issue:** Deployment doesn't progress

**Solutions:**
- SSH might be failing - check connectivity
- Server might be down - check status
- Disk space might be full - check `df -h`
- Check GitHub Actions logs for errors

### Secrets Not Working

**Issue:** Secrets appear as `***` but deployment fails

**Solutions:**
- Verify secret name matches workflow
- Check no typos in variable name
- Regenerate secret if corrupted
- Wait a few minutes after adding secret

## Performance Optimization

### Speed Up Tests

```yaml
# Enable parallel testing
php artisan test --parallel
```

### Cache Dependencies

```yaml
# Already configured in workflows
- uses: actions/cache@v3
  with:
    path: ${{ steps.composer-cache.outputs.dir }}
    key: ${{ runner.os }}-composer-${{ hashFiles('**/composer.lock') }}
```

### Reduce Build Time

- Skip code quality checks for PRs
- Use matrix builds for multiple PHP versions
- Cache npm dependencies
- Use prebuilt Docker images

## Real-time Monitoring

### GitHub Status Page
https://www.githubstatus.com

### Actions Runner Status
- Runners are usually very fast
- Check if hosted runners are available

### Action Logs
- Check logs for specific failures
- Look for timeouts or memory issues

## Best Practices

1. **Run Tests Locally First**
   ```bash
   php artisan test
   ```

2. **Never Commit Secrets**
   - Use GitHub Secrets
   - Never in .env or code

3. **Regular Security Audits**
   - Review security scan results
   - Update dependencies promptly
   - Follow CVE announcements

4. **Monitor Deployments**
   - Set up Slack notifications
   - Monitor error tracking (Sentry)
   - Check application logs

5. **Maintain Backups**
   - Auto backup before deployment
   - Test restore procedures
   - Keep rollback plan ready

## Useful Links

- [GitHub Actions Docs](https://docs.github.com/en/actions)
- [Laravel Testing](https://laravel.com/docs/testing)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [Codecov Integration](https://codecov.io)

---

**All workflows are now ready to use!** 🚀
