# 📝 Laravel To-Do List Application

A clean, production-ready **To-Do List App** built with the **Laravel framework** and **SQLite database**, following senior-level engineering practices.  
This project demonstrates CRUD operations, search, pagination, filtering, RESTful APIs, deployment preparation, and monitoring.

---

## 📚 Table of Contents
1. [Project Overview](#project-overview)
2. [Features](#features)
3. [Architecture](#architecture)
4. [Setup & Installation](#setup--installation)
5. [Database Schema](#database-schema)
6. [Eloquent Model](#eloquent-model)
7. [Controllers & Routes](#controllers--routes)
8. [Blade Views (UI)](#blade-views-ui)
9. [Search, Pagination & Filtering](#search-pagination--filtering)
10. [Factories & Seeders](#factories--seeders)
11. [RESTful API Endpoints](#restful-api-endpoints)
12. [Deployment Preparation](#deployment-preparation)
13. [Monitoring & Maintenance](#monitoring--maintenance)
14. [Continuous Deployment (CI/CD)](#continuous-deployment-cicd)
15. [Future Enhancements](#future-enhancements)

---

## 📖 Project Overview

This application allows users to:

- Create, read, update, and delete tasks.
- Mark tasks as completed or pending.
- Search, paginate, and filter tasks.
- Access tasks via RESTful API endpoints.
- Deploy and maintain the app with CI/CD pipelines.

---

## ✨ Features

- **CRUD Operations**: Manage tasks with title, description, and status.
- **SQLite Database**: Lightweight and easy to set up.
- **Blade Views**: Bootstrap-styled UI for task management.
- **Search & Pagination**: Efficient browsing of tasks.
- **Filtering & Sorting**: View tasks by status or order.
- **Factories & Seeders**: Generate sample tasks for testing.
- **RESTful API**: JSON endpoints for external clients.
- **Deployment Ready**: Optimized configuration for production.
- **Monitoring & Maintenance**: Error tracking, backups, and performance monitoring.
- **CI/CD**: Automated testing and deployment pipeline.

---

## 🏗 Architecture

- **MVC Pattern**: Laravel’s Model-View-Controller structure.
- **Clean Code**: Query scopes, validation, and resource controllers.
- **Separation of Concerns**: UI, API, and business logic are modular.
- **Scalable**: Ready for authentication, multi-user support, and cloud deployment.

---

## ⚙️ Setup & Installation

```bash
# Clone repository
git clone https://github.com/your-username/todo-app.git
cd todo-app

# Install dependencies
composer install
npm install && npm run build

# Configure environment
cp .env.example .env
php artisan key:generate

# Setup SQLite database
touch database/database.sqlite
php artisan migrate --seed

# Run local server
php artisan serve
```

---

## 🗄 Database Schema

### Tasks Table

| Column         | Type      | Description                     |
|----------------|-----------|---------------------------------|
| id             | Integer   | Primary Key                     |
| title          | String    | Required task title             |
| description    | Text      | Optional task description       |
| is_completed   | Boolean   | Default: false                  |
| created_at     | Timestamp | Record creation timestamp       |
| updated_at     | Timestamp | Record update timestamp         |

---

## 📦 Eloquent Model

### Fillable Attributes

```php
protected $fillable = [
    'title',
    'description',
    'is_completed'
];
```

### Casts

```php
protected $casts = [
    'is_completed' => 'boolean',
];
```

### Query Scopes

```php
public function scopeCompleted($query)
{
    return $query->where('is_completed', true);
}

public function scopePending($query)
{
    return $query->where('is_completed', false);
}
```

---

## 🎛 Controllers & Routes

### Web Routes

```php
Route::resource('tasks', TaskController::class);
```

### API Routes

```php
Route::apiResource('tasks', Api\TaskController::class);
```

### Controller Methods

| Method      | Purpose              |
|-------------|----------------------|
| index()     | List all tasks       |
| store()     | Create a new task    |
| show()      | Display single task  |
| update()    | Update existing task |
| destroy()   | Delete task          |

---

## 🎨 Blade Views (UI)

### Layout
- Bootstrap-styled navigation and layout.

### Pages

- **Index Page** → Task list with actions and status badges.
- **Create Page** → Form for creating new tasks.
- **Edit Page** → Form for updating tasks.
- **Show Page** → Detailed task view.

---

## 🔍 Search, Pagination & Filtering

### Search
- Search tasks by title or description.

### Pagination
- Display 10 tasks per page using Laravel pagination.

### Filtering
- Filter completed or pending tasks.

### Sorting
- Latest tasks
- Oldest tasks
- Alphabetical order

---

## 🧪 Factories & Seeders

### TaskFactory
Generates random task data using Faker.

### DatabaseSeeder
Seeds 50 sample tasks into the database.

```bash
php artisan db:seed
```

---

## 🌐 RESTful API Endpoints

| Method | Endpoint          | Description       |
|--------|-------------------|-------------------|
| GET    | /api/tasks        | List all tasks    |
| POST   | /api/tasks        | Create new task   |
| GET    | /api/tasks/{id}   | Show single task  |
| PUT    | /api/tasks/{id}   | Update task       |
| DELETE | /api/tasks/{id}   | Delete task       |

---

## 🚀 Deployment Preparation

### Optimize Autoloader

```bash
composer install --optimize-autoloader --no-dev
```

### Cache Configurations

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Run Migrations

```bash
php artisan migrate --force
```

### Production Best Practices

- Secure `.env` file
- Enable HTTPS
- Disable debug mode
- Configure proper file permissions

---

## 🛡 Monitoring & Maintenance

### Error Tracking
- Sentry
- Bugsnag

### Performance Monitoring
- New Relic
- Datadog

### Backups
- Automated SQLite backups

### Log Rotation
- Prevent oversized application logs

### Scheduled Jobs
Use Laravel Scheduler for:
- Cleanup tasks
- Notifications
- Reminders

---

## 🔄 Continuous Deployment (CI/CD)

### GitHub Actions Workflow

1. Checkout repository
2. Install dependencies
3. Run automated tests
4. Build frontend assets
5. Deploy application via SSH

### Security

- Store credentials in GitHub Secrets
- Avoid hardcoded environment variables

### Automated Testing

Run tests before deployment:

```bash
php artisan test
```

---

## 🌟 Future Enhancements

- User authentication using Laravel Breeze or Jetstream
- Task categories and tags
- Email/SMS notifications
- Reminder scheduling
- Swagger/OpenAPI documentation
- Docker support for containerized deployment
- Multi-user collaboration support

---

## 👨‍💻 Author

Developed step by step with Laravel best practices and clean architecture.

This project serves as a strong foundation for learning, scaling, and deploying Laravel applications in real-world environments.

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---