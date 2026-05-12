# 🌐 Laravel Portfolio Site

A clean, CMS-like **Portfolio Site** built with Laravel and SQLite, following senior-level architecture principles.  
This project showcases **Projects, Skills, About, and Contacts** with CRUD operations, search, pagination, sorting, filtering, Markdown support, and RESTful APIs.

---

## 🏗️ System Architecture

- **Framework**: Laravel (MVC + service-oriented design)
- **Database**: SQLite (lightweight, file-based)

### Structure
- **Controllers** → Handle requests
- **Models** → Represent entities (Projects, Skills, About, Contacts)
- **Services** → Business logic (e.g., Markdown rendering)
- **Repositories** → Abstract database queries
- **Views** → Blade templates for UI

---

## 📂 Database Schema

### projects
| Column | Type |
|---|---|
| id | integer |
| title | string |
| description | text |
| image | string |
| link | string |
| timestamps | timestamps |

### skills
| Column | Type |
|---|---|
| id | integer |
| name | string |
| level | string |
| timestamps | timestamps |

### abouts
| Column | Type |
|---|---|
| id | integer |
| content | text |
| timestamps | timestamps |

### contacts
| Column | Type |
|---|---|
| id | integer |
| name | string |
| email | string |
| message | text |
| timestamps | timestamps |

---

## 🔑 Features

- **CRUD** for Projects, Skills, About, Contacts
- **Search & Pagination** for all modules
- **Sorting & Filtering** (by title, level, email domain, etc.)
- **Markdown Support** for rich text in About & Projects
- **RESTful API Endpoints** with JSON responses
- **Swagger/OpenAPI Documentation** for interactive API usage
- **Deployment Ready** with caching, optimization, and CI/CD pipeline
- **Monitoring & Scaling** with logging, error tracking, and caching strategies

---

## 🚀 Installation

```bash
git clone https://github.com/yourusername/portfolio-site.git
cd portfolio-site

composer install

npm install
npm run dev

cp .env.example .env

php artisan key:generate

php artisan migrate --seed

php artisan serve
```

Application URL:

```bash
http://127.0.0.1:8000
```

---

## 🌐 API Endpoints

### Projects API

| Method | Endpoint | Description |
|---|---|---|
| GET | /api/projects | List projects |
| POST | /api/projects | Create project |
| GET | /api/projects/{id} | Show project |
| PUT | /api/projects/{id} | Update project |
| DELETE | /api/projects/{id} | Delete project |

### Skills API

| Method | Endpoint | Description |
|---|---|---|
| GET | /api/skills | List skills |
| POST | /api/skills | Create skill |
| GET | /api/skills/{id} | Show skill |
| PUT | /api/skills/{id} | Update skill |
| DELETE | /api/skills/{id} | Delete skill |

### About API

| Method | Endpoint | Description |
|---|---|---|
| GET | /api/abouts | List about entries |
| POST | /api/abouts | Create about entry |
| GET | /api/abouts/{id} | Show about entry |
| PUT | /api/abouts/{id} | Update about entry |
| DELETE | /api/abouts/{id} | Delete about entry |

### Contacts API

| Method | Endpoint | Description |
|---|---|---|
| GET | /api/contacts | List contacts |
| POST | /api/contacts | Create contact |
| GET | /api/contacts/{id} | Show contact |
| PUT | /api/contacts/{id} | Update contact |
| DELETE | /api/contacts/{id} | Delete contact |

---

## 📖 API Documentation

Swagger UI available at:

```bash
http://your-app.test/api/documentation
```

---

## 🛡️ Deployment Preparation

- Set production environment variables:

```env
APP_ENV=production
APP_DEBUG=false
```

- Cache configuration and routes:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

- Ensure correct permissions for:
  - `storage/`
  - `bootstrap/cache/`

- Use HTTPS and secure `.env` values

---

## ⚡ Scaling & Optimization

- Database indexing on frequently queried fields
- Query optimization with eager loading
- Caching heavy queries with Redis or file cache
- CDN integration for static assets
- Queue workers for background tasks

---

## 📊 Monitoring & Maintenance

- Error tracking with Sentry or Laravel Telescope
- Automated backups with Spatie Laravel Backup
- Uptime monitoring with Pingdom or UptimeRobot
- CI/CD pipeline with GitHub Actions

---

## ✅ Outcome

This Portfolio Site is a production-ready Laravel application with:

- Clean architecture
- Rich UI/UX features
- RESTful API + documentation
- Deployment automation
- Monitoring & scaling strategies

---

## 📜 License

Open-source project — feel free to use and extend.