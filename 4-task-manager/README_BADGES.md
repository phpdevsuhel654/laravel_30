# README Update Template

Add this section to your project's README.md file to show CI/CD status badges.

## Markdown to Add to README.md

```markdown
## CI/CD Pipeline

[![Tests](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/tests.yml)
[![Code Quality](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/code-quality.yml/badge.svg?branch=main)](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/code-quality.yml)
[![Security](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/security.yml/badge.svg?branch=main)](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/security.yml)
[![Deploy](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/deploy.yml/badge.svg?branch=main)](https://github.com/YOUR_USERNAME/REPO_NAME/actions/workflows/deploy.yml)

[![Codecov](https://codecov.io/gh/YOUR_USERNAME/REPO_NAME/branch/main/graph/badge.svg)](https://codecov.io/gh/YOUR_USERNAME/REPO_NAME)

This project uses GitHub Actions for:
- ✅ Automated testing on every commit
- ✅ Code quality & style validation
- ✅ Security scanning & vulnerability detection
- ✅ Automated staging deployment
- ✅ Production deployment on demand

See [CI/CD Documentation](CI_CD_GUIDE.md) for setup and usage.
```

## Steps to Add Badges

1. Edit your README.md
2. Find a good location (usually near the top or after the description)
3. Replace `YOUR_USERNAME` and `REPO_NAME` with your actual GitHub username and repository name
4. Add the markdown section above
5. Commit and push

## Example

If your repository is at `https://github.com/john-doe/task-manager`:

Replace:
- `YOUR_USERNAME` → `john-doe`
- `REPO_NAME` → `task-manager`

Result:
```markdown
[![Tests](https://github.com/john-doe/task-manager/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/john-doe/task-manager/actions/workflows/tests.yml)
```

## What the Badges Show

| Badge | Shows |
|-------|-------|
| Tests | ✅ All tests passing / ❌ Tests failing |
| Code Quality | ✅ No quality issues / ⚠️ Issues found |
| Security | ✅ No vulnerabilities / ⚠️ Issues found |
| Deploy | ✅ Deployment succeeded / ❌ Deployment failed |
| Codecov | Code coverage percentage |

## Clicking the Badges

Each badge is a clickable link to:
- **Tests** → Latest test workflow results
- **Code Quality** → Latest code quality check
- **Security** → Latest security scan
- **Deploy** → Latest deployment status
- **Codecov** → Coverage reports

## Additional Status Information

You can also add more details to your README:

```markdown
## Deployment Information

- **Main Branch**: Automatically deploys to staging on push
- **Production**: Manual deployment via GitHub Actions
- **Staging URL**: https://staging.example.com
- **Production URL**: https://app.example.com

## Testing

- Tests run automatically on every push and pull request
- Coverage reports available in Codecov
- Local testing: `php artisan test`

## Documentation

- [CI/CD Setup Guide](CI_CD_GUIDE.md)
- [Quick Start Guide](QUICK_START_CI_CD.md)
- [Workflows Reference](WORKFLOWS_REFERENCE.md)
- [Setup Checklist](CI_CD_CHECKLIST.md)
```

## Full README Example Section

```markdown
# Task Manager

A Laravel application for managing tasks with team collaboration features.

## CI/CD Pipeline

[![Tests](https://github.com/your-username/task-manager/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/your-username/task-manager/actions/workflows/tests.yml)
[![Code Quality](https://github.com/your-username/task-manager/actions/workflows/code-quality.yml/badge.svg?branch=main)](https://github.com/your-username/task-manager/actions/workflows/code-quality.yml)
[![Security](https://github.com/your-username/task-manager/actions/workflows/security.yml/badge.svg?branch=main)](https://github.com/your-username/task-manager/actions/workflows/security.yml)
[![Deploy](https://github.com/your-username/task-manager/actions/workflows/deploy.yml/badge.svg?branch=main)](https://github.com/your-username/task-manager/actions/workflows/deploy.yml)

## About

This project demonstrates:
- Modern Laravel application development
- Comprehensive CI/CD pipeline setup
- Automated testing and deployment
- API design and documentation
- Production-ready configurations

## Quick Links

- [API Documentation](API_DOCUMENTATION.md)
- [CI/CD Guide](CI_CD_GUIDE.md)
- [Deployment Guide](QUICK_START_CI_CD.md)

## Features

- User management with role-based access
- Task management with filtering and searching
- Real-time API with comprehensive documentation
- Automated testing and deployment
- Security scanning and monitoring

## Getting Started

### Local Development

```bash
# Clone and setup
git clone https://github.com/your-username/task-manager.git
cd task-manager

# Setup development environment
./ci-cd-helper.sh dev-setup

# Run development server
php artisan serve
```

### Testing

```bash
# Run all tests
php artisan test

# With coverage
php artisan test --coverage

# Run CI pipeline locally
./ci-cd-helper.sh ci-simulate
```

## Deployment

See [CI/CD Documentation](CI_CD_GUIDE.md) for production deployment setup.

### Automated Deployment

Push to `main` branch:
```bash
git push origin main
```

The application automatically deploys to staging. Production deployment requires manual approval.

## Documentation

- [API Documentation](API_DOCUMENTATION.md)
- [CI/CD Setup Guide](CI_CD_GUIDE.md)
- [Quick Start Guide](QUICK_START_CI_CD.md)
- [Workflows Reference](WORKFLOWS_REFERENCE.md)
- [Setup Checklist](CI_CD_CHECKLIST.md)

## Requirements

- PHP 8.3+
- MySQL 8.0+
- Node.js 18+
- Composer
- npm

## License

MIT License - see LICENSE file

## Support

For issues, questions, or contributions:
1. Check documentation files
2. Review GitHub Actions logs
3. Create an issue with details
```

## Testing the Badges

After adding badges, verify they work:

1. Commit the README changes
2. Wait for GitHub to update
3. View your README on GitHub
4. Click each badge to verify they link correctly
5. Check that status updates in real-time

## Troubleshooting Badge Issues

### Badges Show "Unknown"

- Wait a few minutes for initial workflow run
- Verify workflow names match exactly
- Check repository name spelling

### Badges Don't Update

- Refresh page (Ctrl+F5)
- Check GitHub Actions tab to verify workflows ran
- Wait 5-10 minutes for cache to update

### Links Go to Wrong Place

- Verify repository name in URL
- Check username spelling
- Ensure workflow file names are correct

## Badge Customization

### Change Badge Style

Add `?style=STYLE` to any badge URL:

- `plastic`
- `flat` (default)
- `flat-square`
- `for-the-badge`
- `social`

Example:
```markdown
[![Tests](https://github.com/your-username/repo/actions/workflows/tests.yml/badge.svg?style=for-the-badge)](...)
```

### Add Custom Message

You can use shields.io for custom badges:

```markdown
[![Build](https://img.shields.io/badge/build-passing-brightgreen)](https://github.com/your-username/repo)
[![Maintained](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://github.com/your-username/repo)
```

## Advanced Badge Options

```markdown
<!-- Show badge for specific branch -->
[![Tests](https://github.com/user/repo/actions/workflows/tests.yml/badge.svg?branch=develop)](...)

<!-- Show badge with build details -->
[![Build Status](https://github.com/user/repo/workflows/Tests/badge.svg?branch=main&event=push)](...)

<!-- Use static shields.io badge -->
[![Coverage](https://img.shields.io/codecov/c/github/user/repo)](...)
```

## References

- [GitHub Actions Badges](https://docs.github.com/en/actions/monitoring-and-troubleshooting-workflows/adding-a-workflow-status-badge)
- [Shields.io](https://shields.io) - Badge customization
- [Codecov Badges](https://docs.codecov.io/docs/status-badges)

---

**Ready to show off your CI/CD pipeline?** Add these badges to your README now!
