# Task Manager Application

<p align="center">
  <strong>A modern Laravel 13 task management application with REST API, comprehensive CI/CD pipeline, and automated testing.</strong>
</p>

<p align="center">
  <a href="#features">Features</a> •
  <a href="#quick-start">Quick Start</a> •
  <a href="#api-documentation">API</a> •
  <a href="#ci-cd-pipeline">CI/CD</a> •
  <a href="#testing">Testing</a> •
  <a href="#deployment">Deployment</a>
</p>

---

## 📊 Status Badges

<!-- Add your own badges here - replace GITHUB_USERNAME and REPOSITORY_NAME -->
<!-- Uncomment after pushing to GitHub and configuring workflows -->
<!--
[![Tests](https://github.com/GITHUB_USERNAME/REPOSITORY_NAME/actions/workflows/tests.yml/badge.svg)](https://github.com/GITHUB_USERNAME/REPOSITORY_NAME/actions/workflows/tests.yml)
[![Code Quality](https://github.com/GITHUB_USERNAME/REPOSITORY_NAME/actions/workflows/code-quality.yml/badge.svg)](https://github.com/GITHUB_USERNAME/REPOSITORY_NAME/actions/workflows/code-quality.yml)
[![Security](https://github.com/GITHUB_USERNAME/REPOSITORY_NAME/actions/workflows/security.yml/badge.svg)](https://github.com/GITHUB_USERNAME/REPOSITORY_NAME/actions/workflows/security.yml)
[![codecov](https://codecov.io/gh/GITHUB_USERNAME/REPOSITORY_NAME/branch/main/graph/badge.svg)](https://codecov.io/gh/GITHUB_USERNAME/REPOSITORY_NAME)
-->

See [README_BADGES.md](README_BADGES.md) for badge setup instructions.

---

## 🎯 Features

### Task Management
- ✅ Create, read, update, and delete tasks
- ✅ Mark tasks as complete/incomplete
- ✅ Task filtering and search
- ✅ Responsive dashboard with Tailwind CSS
- ✅ Real-time task status updates

### REST API
- ✅ Complete RESTful API with 6 endpoints
- ✅ OpenAPI 3.0 specification
- ✅ Interactive API tester (no external tools needed)
- ✅ Swagger/OpenAPI documentation
- ✅ JSON request/response format
- ✅ Comprehensive validation and error handling

### Automation & Quality
- ✅ Automated testing with Pest framework
- ✅ Code coverage reporting (Codecov)
- ✅ Code style validation (Laravel Pint)
- ✅ Static analysis (PHPStan)
- ✅ Daily security scanning
- ✅ Dependency vulnerability checks

### CI/CD Pipeline
- ✅ Automated tests on every push
- ✅ Code quality checks
- ✅ Security scanning
- ✅ Staging deployment
- ✅ Production deployment
- ✅ Slack notifications

### Developer Experience
- ✅ Database seeding with test data
- ✅ Helper scripts for common tasks
- ✅ Comprehensive documentation
- ✅ Local development setup guide
- ✅ Troubleshooting guides

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.3+ with extensions: PDO, openssl, mbstring, pdo_sqlite
- Node.js 18+ (for frontend assets)
- Composer
- Git

### Installation

```bash
# Clone the repository
git clone https://github.com/username/task-manager.git
cd task-manager

# Install dependencies
composer install
npm install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations and seed database
php artisan migrate --seed

# Build frontend assets
npm run build

# Start development server
php artisan serve
```

### Access the Application

- **Web UI**: http://localhost:8000
- **API Tester**: http://localhost:8000/api-tester
- **Swagger UI**: http://localhost:8000/api/documentation (after L5-Swagger installs)

---

## 🔑 Test Credentials

Use these credentials to log in to the application:

```
Email:    test@example.com
Password: password
```

These are automatically created when you run `php artisan migrate --seed`.

---

## 📚 API Documentation

### Quick Links
- [Interactive API Tester](http://localhost:8000/api-tester) - Test all endpoints in your browser
- [API Documentation](API_DOCUMENTATION.md) - Complete API reference with examples
- [API Setup Guide](SETUP_API.md) - How to use the API

### Available Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/tasks` | List all tasks with pagination |
| GET | `/api/tasks/{id}` | Get a specific task |
| POST | `/api/tasks` | Create a new task |
| PUT | `/api/tasks/{id}` | Update a task |
| DELETE | `/api/tasks/{id}` | Delete a task |
| POST | `/api/tasks/{id}/toggle-completion` | Toggle task completion status |

### Example Usage

```bash
# Get all tasks
curl http://localhost:8000/api/tasks

# Create a task
curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -d '{"title": "My Task", "description": "Task description"}'

# Update a task
curl -X PUT http://localhost:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{"title": "Updated Task", "completed": true}'

# Toggle task completion
curl -X POST http://localhost:8000/api/tasks/1/toggle-completion
```

See [API_DOCUMENTATION.md](API_DOCUMENTATION.md) for complete details.

---

## 🧪 Testing

### Run Tests

```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/TaskApiTest.php

# Run tests matching a pattern
php artisan test --filter=task_creation
```

### Using Helper Script

```bash
# Make the script executable
chmod +x ci-cd-helper.sh

# Run tests
./ci-cd-helper.sh test

# Run with coverage
./ci-cd-helper.sh test-coverage
```

### Code Quality Checks

```bash
# Check code style
./ci-cd-helper.sh code-style

# Fix code style issues
./ci-cd-helper.sh code-style-fix

# Static analysis
./ci-cd-helper.sh static-analysis

# Security check
./ci-cd-helper.sh security-check
```

---

## 🔄 CI/CD Pipeline

### Overview

Comprehensive automated pipeline with 4 workflows:

1. **Tests Workflow** - Automated testing on every push/PR
2. **Code Quality Workflow** - Code style & static analysis checks
3. **Security Workflow** - Daily security scanning
4. **Deploy Workflow** - Automated production deployment

### Quick Links
- [CI/CD Index](CI_CD_INDEX.md) - Navigation guide (START HERE!)
- [Quick Start Guide](QUICK_START_CI_CD.md) - 5-minute overview
- [Complete CI/CD Guide](CI_CD_GUIDE.md) - Comprehensive setup documentation
- [Workflows Reference](WORKFLOWS_REFERENCE.md) - Detailed workflow documentation
- [Setup Checklist](CI_CD_CHECKLIST.md) - Step-by-step verification

### Running Locally

```bash
# Simulate full CI pipeline
./ci-cd-helper.sh ci-simulate

# Complete development setup
./ci-cd-helper.sh dev-setup

# Health check
./ci-cd-helper.sh health-check
```

---

## 🚀 Deployment

### Staging Deployment

```bash
# Manual staging deployment
./deploy-staging.sh

# Or using helper script
./ci-cd-helper.sh deploy-staging
```

### Production Deployment

Requires GitHub secrets configuration. See [CI_CD_GUIDE.md](CI_CD_GUIDE.md#github-secrets-configuration) for setup.

Automated on merge to `main` branch, or trigger manually via GitHub Actions.

### Deployment Requirements

- Server with PHP 8.3+, MySQL 8.0+, Node.js 18+
- SSH access configured
- GitHub secrets configured (DEPLOY_USER, DEPLOY_HOST, DEPLOY_PATH, DEPLOY_SSH_KEY)

See [CI_CD_GUIDE.md](CI_CD_GUIDE.md) for complete deployment guide.

---

## 📁 Project Structure

```
.
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── TaskController.php         # Web UI task management
│   │   │   └── Api/
│   │   │       ├── TaskApiController.php  # REST API endpoints
│   │   │       └── Schemas.php            # OpenAPI schemas
│   │   └── Requests/
│   ├── Models/
│   │   └── Task.php
│   └── ...
├── resources/
│   ├── views/
│   │   ├── tasks/                         # Task management UI
│   │   └── layouts/
│   └── js/
├── routes/
│   ├── web.php                            # Web routes
│   └── api.php                            # API routes & OpenAPI
├── database/
│   ├── migrations/
│   └── seeders/
├── tests/
│   ├── Feature/
│   │   └── TaskApiTest.php
│   └── Unit/
├── .github/workflows/                     # GitHub Actions workflows
│   ├── tests.yml
│   ├── code-quality.yml
│   ├── security.yml
│   └── deploy.yml
├── public/
│   └── api-tester.html                    # Interactive API tester
├── docs/                                  # Documentation
│   ├── API_DOCUMENTATION.md
│   ├── SETUP_API.md
│   ├── CI_CD_GUIDE.md
│   └── ...
└── ...
```

---

## 🛠️ Available Commands

```bash
# Development
php artisan serve                # Start development server
npm run dev                      # Compile assets in watch mode
npm run build                    # Build production assets

# Database
php artisan migrate              # Run migrations
php artisan migrate --seed       # Run migrations and seed
php artisan migrate:refresh      # Refresh database (WARNING: deletes data)

# Testing
php artisan test                 # Run tests
php artisan test --coverage      # Run tests with coverage
./ci-cd-helper.sh test          # Run tests via helper

# Code Quality
php artisan pint                 # Fix code style
./ci-cd-helper.sh code-style    # Check style
./ci-cd-helper.sh static-analysis # Run static analysis

# Caching & Optimization
php artisan cache:clear         # Clear application cache
php artisan optimize            # Optimize application
./ci-cd-helper.sh cache-optimize # Production cache optimization

# Help
./ci-cd-helper.sh help          # Show all available helper commands
```

---

## 📖 Documentation

- **[CI_CD_INDEX.md](CI_CD_INDEX.md)** - Start here for CI/CD documentation
- **[CI_CD_GUIDE.md](CI_CD_GUIDE.md)** - Comprehensive CI/CD setup guide
- **[API_DOCUMENTATION.md](API_DOCUMENTATION.md)** - Complete API reference
- **[SETUP_API.md](SETUP_API.md)** - API setup and usage
- **[CI_CD_CHECKLIST.md](CI_CD_CHECKLIST.md)** - Setup verification checklist
- **[QUICK_START_CI_CD.md](QUICK_START_CI_CD.md)** - 5-minute CI/CD overview
- **[README_BADGES.md](README_BADGES.md)** - How to add status badges

---

## 🔒 Security

### Security Features
- CSRF protection on forms
- SQL injection prevention (ORM)
- XSS protection (Blade templating)
- Password hashing (bcrypt)
- API request validation
- Daily security scanning
- Dependency vulnerability checks

### Reporting Security Vulnerabilities

If you discover a security vulnerability, please email security@example.com instead of using the issue tracker.

---

## 📝 Environment Configuration

### Development (.env)

```bash
APP_ENV=local
APP_DEBUG=true
DATABASE_DRIVER=sqlite
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
```

### Staging (.env.staging)

See [.env.staging](.env.staging) for staging configuration.

### Production (.env.production)

See [.env.production](.env.production) for production configuration.

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Before Submitting PR

- ✅ Run tests: `php artisan test`
- ✅ Check code style: `./ci-cd-helper.sh code-style`
- ✅ Run static analysis: `./ci-cd-helper.sh static-analysis`
- ✅ Update documentation if needed

---

## 📋 Requirements

- PHP 8.3+
- Composer 2.0+
- Node.js 18+
- SQLite or MySQL 8.0+
- Git

### PHP Extensions Required
- pdo
- pdo_sqlite
- pdo_mysql
- mbstring
- openssl
- tokenizer
- xml
- ctype
- json
- bcmath

---

## 📞 Support

### Getting Help

1. Check the [CI_CD_GUIDE.md](CI_CD_GUIDE.md#troubleshooting) troubleshooting section
2. Read [API_DOCUMENTATION.md](API_DOCUMENTATION.md) for API-related questions
3. Review [GitHub Issues](https://github.com/username/task-manager/issues)
4. Check Laravel documentation: https://laravel.com/docs

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🙏 Acknowledgments

- Built with [Laravel 13](https://laravel.com)
- Testing with [Pest](https://pestphp.com)
- API documentation with [L5-Swagger](https://github.com/darkaonline/l5-swagger)
- Frontend with [Tailwind CSS](https://tailwindcss.com)
- CI/CD powered by [GitHub Actions](https://github.com/features/actions)

---

**Ready to get started?** See [Quick Start](#-quick-start) or [CI_CD_INDEX.md](CI_CD_INDEX.md) for comprehensive setup guides.
