# CI/CD Pipeline Documentation

## Overview

This document describes the Continuous Integration/Continuous Deployment (CI/CD) pipeline for the Task Manager Laravel application. The pipeline is implemented using GitHub Actions and includes automated testing, code quality checks, security scanning, and deployment to production.

## Architecture

```
┌─────────────────┐
│  Git Push/PR    │
└────────┬────────┘
         │
         ├──────────────────────────┬──────────────────────┬──────────────────┐
         │                          │                      │                  │
         v                          v                      v                  v
    ┌────────┐              ┌─────────────┐        ┌──────────────┐    ┌──────────┐
    │ Tests  │              │Code Quality │        │  Security    │    │ Lint     │
    └────────┘              └─────────────┘        └──────────────┘    └──────────┘
         │                          │                      │                  │
         └──────────────────────────┴──────────────────────┴──────────────────┘
                                    │
                          ┌─────────v─────────┐
                          │  All Passed?      │
                          └────────┬──────────┘
                                   │
                    ┌──────────────┴──────────────┐
                    │                             │
                    v                             v
              ┌────────┐                   ┌───────────────┐
              │ FAILED │                   │  Deploy       │
              │ (Stop) │                   │  Staging/Prod │
              └────────┘                   └───────────────┘
```

## GitHub Actions Workflows

### 1. **Tests Workflow** (`.github/workflows/tests.yml`)

Runs on every push to `main` and `develop` branches, and on pull requests.

**Triggers:**
- Push to `main` or `develop`
- Pull requests to `main` or `develop`

**Jobs:**
- Setup PHP 8.3 environment
- Cache Composer dependencies
- Install dependencies
- Run database migrations
- Execute test suite with coverage
- Upload coverage reports to Codecov
- Archive test results

**Failure Handling:**
- If tests fail, the workflow stops and deployment is blocked

### 2. **Code Quality Workflow** (`.github/workflows/code-quality.yml`)

Validates code style and static analysis.

**Triggers:**
- Push to `main` or `develop`
- Pull requests

**Checks:**
- Laravel Pint (code style/formatting)
- PHPStan (static analysis)
- Security vulnerability scanning
- Configuration file linting
- Migration status check

**Status:** Continue on error (warnings don't block deployment)

### 3. **Deploy Workflow** (`.github/workflows/deploy.yml`)

Handles deployment to staging and production environments.

**Triggers:**
- Push to `main` branch
- Manual workflow dispatch (for on-demand deployments)

**Environment Selection:**
- Staging: For every push to `main`
- Production: Manual trigger via `workflow_dispatch`

**Deployment Steps:**
1. Build production dependencies (--no-dev)
2. Compile frontend assets
3. Create deployment package
4. Transfer via SCP
5. Extract and prepare application
6. Run migrations
7. Cache configuration
8. Restart services
9. Health checks
10. Slack notification

### 4. **Security Workflow** (`.github/workflows/security.yml`)

Automated security scanning and vulnerability checks.

**Triggers:**
- Daily at 2 AM UTC (cron schedule)
- On changes to `composer.lock` or `package-lock.json`
- Manual trigger

**Checks:**
- Composer package security (Symfony Security Advisories)
- NPM package vulnerabilities
- Trivy filesystem scan
- Creates issues for found vulnerabilities

## Setup Instructions

### Prerequisites

1. GitHub repository with this project
2. Staging and Production servers with:
   - PHP 8.3+
   - MySQL/PostgreSQL
   - Node.js 18+
   - SSH access configured

3. GitHub Secrets configured (see below)

### GitHub Secrets Configuration

Add these secrets to your GitHub repository (Settings > Secrets):

**For Deployment:**
```
DEPLOY_USER              # SSH user (e.g., deploy)
DEPLOY_HOST              # Server hostname (e.g., staging.example.com)
DEPLOY_PATH              # Deployment path (e.g., /var/www/task-manager)
DEPLOY_SSH_KEY           # Private SSH key for authentication
DEPLOY_SSH_PORT          # SSH port (default: 22)
```

**For Notifications:**
```
SLACK_WEBHOOK            # Slack webhook URL for notifications
```

**Environment Variables:**
```
DB_PASSWORD              # Database password for staging/prod
MAIL_PASSWORD            # Email service password
PUSHER_APP_KEY           # Pusher credentials
SENTRY_LARAVEL_DSN       # Sentry error tracking DSN
AWS_SECRET_ACCESS_KEY    # AWS credentials (if using S3)
```

### Setting Up Secrets

1. Go to your GitHub repository
2. Click Settings → Secrets and variables → Actions
3. Click "New repository secret"
4. Add each secret with its value

Example:
```
Name: DEPLOY_USER
Value: deploy

Name: DEPLOY_HOST
Value: staging.example.com

Name: DEPLOY_SSH_KEY
Value: (paste your private key)
```

## Local Deployment Scripts

### Deploy to Staging

```bash
chmod +x deploy-staging.sh
./deploy-staging.sh
```

**Configuration via Environment Variables:**
```bash
DEPLOY_USER=deploy \
DEPLOY_HOST=staging.example.com \
DEPLOY_PATH=/var/www/task-manager \
DEPLOY_SSH_PORT=22 \
./deploy-staging.sh
```

## Workflow Statuses & Badges

Add these badges to your README.md:

```markdown
[![Tests](https://github.com/USERNAME/REPO/workflows/Tests/badge.svg)](https://github.com/USERNAME/REPO/actions/workflows/tests.yml)
[![Code Quality](https://github.com/USERNAME/REPO/workflows/Code%20Quality/badge.svg)](https://github.com/USERNAME/REPO/actions/workflows/code-quality.yml)
[![Deploy](https://github.com/USERNAME/REPO/workflows/Deploy%20to%20Production/badge.svg)](https://github.com/USERNAME/REPO/actions/workflows/deploy.yml)
[![Security](https://github.com/USERNAME/REPO/workflows/Security%20%26%20Dependency%20Checks/badge.svg)](https://github.com/USERNAME/REPO/actions/workflows/security.yml)
```

## Branch Strategy

```
main (production)
  ├─ Requires all checks to pass before merge
  ├─ Auto-deploys on push
  └─ Protected branch with admin reviews

develop (staging)
  ├─ Integration branch
  ├─ Tests run on all PRs
  └─ Manual approval for merge to main

feature/* (feature branches)
  ├─ Created from develop
  ├─ Tests run on PR
  └─ Merged back to develop
```

## Environment Files

### Development (Local)
```
.env                     # Your local development config
```

### Staging
```
.env.staging             # Staging environment variables
```

### Production
```
.env.production          # Production environment variables
```

Each environment file should contain environment-specific configuration with secrets managed via GitHub Secrets.

## Monitoring & Notifications

### Email Notifications
- Tests: GitHub default notifications
- Deploy: Custom email on success/failure

### Slack Notifications
Configure webhook URL in GitHub Secrets as `SLACK_WEBHOOK`

Notifications include:
- Deployment status (success/failure)
- Branch and commit information
- Author details
- Timestamps

### Error Tracking (Optional)
Set `SENTRY_LARAVEL_DSN` to monitor production errors in real-time

## Testing Strategy

### Test Levels

1. **Unit Tests** - Individual component testing
   ```bash
   php artisan test --filter=UnitTest
   ```

2. **Feature Tests** - Workflow and API testing
   ```bash
   php artisan test --filter=FeatureTest
   ```

3. **Coverage Reports**
   - Generated in `coverage/` directory
   - Uploaded to Codecov
   - Target: >80% coverage for critical paths

### Running Tests Locally

```bash
# All tests
php artisan test

# Specific test file
php artisan test tests/Feature/TaskControllerTest.php

# With coverage
php artisan test --coverage

# Parallel testing
php artisan test --parallel
```

## Code Quality Standards

### PHP Code Style (Pint)

Configuration in `pint.json`

Fix style issues:
```bash
php artisan pint
```

Check without fixing:
```bash
php artisan pint --test
```

### Static Analysis (PHPStan)

Configuration in `phpstan.neon`

Run analysis:
```bash
./vendor/bin/phpstan analyse
```

## Deployment Checklist

Before deploying to production:

- [ ] All tests pass
- [ ] Code quality checks pass
- [ ] Security scan completed
- [ ] No vulnerabilities found
- [ ] Database migrations reviewed
- [ ] Environment variables configured
- [ ] Backup created
- [ ] Deployment window scheduled
- [ ] Team notified
- [ ] Rollback plan prepared

## Troubleshooting

### Workflow Stuck or Taking Too Long

1. Check logs in Actions tab
2. Look for cache issues
3. Review runner resources
4. Try manual re-run

### Deployment Failed

1. Check SSH connectivity
2. Verify secrets are correct
3. Review remote server logs
4. Check disk space
5. Verify permissions

### Tests Failing

1. Review test output
2. Check database setup
3. Verify environment variables
4. Run tests locally
5. Check PHP version compatibility

## Best Practices

1. **Commit Messages**: Use conventional commits
   ```
   feat: add new feature
   fix: resolve bug
   docs: update documentation
   test: add tests
   ```

2. **Pull Requests**: Always create PRs for changes
   - Requires at least 1 review
   - All checks must pass
   - Tests must pass

3. **Protected Branches**: Protect `main` and `develop`
   - Require status checks to pass
   - Require code reviews
   - Dismiss stale reviews on push

4. **Secrets Management**: Never commit secrets
   - Use GitHub Secrets
   - Rotate regularly
   - Use separate secrets per environment

5. **Monitoring**: Set up alerts for
   - Failed deployments
   - Security vulnerabilities
   - Error rate spikes
   - Performance degradation

## Rollback Procedure

If deployment fails or issues occur in production:

1. **Immediate Rollback**
   ```bash
   ssh deploy@prod-server.com
   cd /var/www/task-manager
   
   # List backups
   ls -la app.backup.*
   
   # Restore backup
   rm -rf app
   cp -r app.backup.20240513_120000 app
   
   # Restart services
   systemctl restart php-fpm
   ```

2. **Database Rollback** (if needed)
   ```bash
   php artisan migrate:rollback --steps=1
   ```

3. **Notify Team**
   - Post incident report
   - Document root cause
   - Create follow-up issues

## References

- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [Laravel Testing Documentation](https://laravel.com/docs/testing)
- [Laravel Deployment Documentation](https://laravel.com/docs/deployment)
- [GitHub Branch Protection Rules](https://docs.github.com/en/repositories/configuring-branches-and-merges-in-your-repository/managing-protected-branches)

## Support

For issues or questions about the CI/CD pipeline:

1. Check the workflow logs
2. Review this documentation
3. Create an issue with:
   - Workflow name
   - Error message
   - Recent commits
   - Steps to reproduce
