# API Setup & Usage Guide

## Overview
I have set up a complete REST API for the Task Manager application with comprehensive documentation and testing tools.

## What Has Been Added

### 1. **API Controller**
- **File**: `app/Http/Controllers/Api/TaskApiController.php`
- Complete CRUD operations for tasks
- Full OpenAPI annotations for documentation
- Supports filtering, searching, and sorting
- Additional endpoint: Toggle task completion status

### 2. **API Routes**
- **File**: `routes/api.php`
- RESTful resource routes for tasks
- Custom route for toggling completion status
- OpenAPI info and security scheme definitions

### 3. **OpenAPI Schema Components**
- **File**: `app/Http/Controllers/Api/Schemas.php`
- Task and User model schemas
- Reusable component definitions for documentation

### 4. **L5 Swagger Configuration**
- **File**: `config/l5-swagger.php`
- Configuration for OpenAPI documentation generation
- Swagger UI endpoints
- Annotation paths

### 5. **Documentation Files**
- **File**: `API_DOCUMENTATION.md` - Comprehensive API documentation
- **File**: `public/api-tester.html` - Interactive API testing tool
- **File**: `routes/web.php` - Added documentation routes

## Setup Instructions

### Step 1: Complete L5-Swagger Installation
The composer installation for `darkaonline/l5-swagger` is running in the background. Wait for it to complete, then:

```bash
# Verify installation is complete
composer install

# Publish L5-Swagger configuration (if needed)
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"

# Generate Swagger documentation
php artisan swagger:generate
```

### Step 2: Access the Documentation

#### Option A: Swagger UI (After L5-Swagger is installed)
Once L5-Swagger is fully installed and documentation is generated:
```
http://localhost:8000/api/docs
```

#### Option B: Interactive API Tester (No installation needed!)
```
http://localhost:8000/api-tester
```

#### Option C: Markdown Documentation
```
http://localhost:8000/api/docs  (or read API_DOCUMENTATION.md)
```

## API Endpoints

### Base URL
```
http://localhost:8000/api
```

### Available Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/tasks` | Get all tasks (with filtering & sorting) |
| GET | `/api/tasks/{id}` | Get a single task |
| POST | `/api/tasks` | Create a new task |
| PUT | `/api/tasks/{id}` | Update a task |
| DELETE | `/api/tasks/{id}` | Delete a task |
| POST | `/api/tasks/{id}/toggle-completion` | Toggle task completion status |

### Query Parameters

**For GET /api/tasks:**
- `search` - Search by title or description
- `status` - Filter: `completed` or `pending`
- `sort` - Sort: `latest`, `oldest`, or `title`
- `page` - Page number (pagination)

## Examples

### Using cURL

```bash
# Get all tasks
curl http://localhost:8000/api/tasks

# Get completed tasks
curl "http://localhost:8000/api/tasks?status=completed&sort=latest"

# Search tasks
curl "http://localhost:8000/api/tasks?search=project"

# Create task
curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -d '{
    "title": "New Task",
    "description": "Task description",
    "user_id": 1
  }'

# Update task
curl -X PUT http://localhost:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Updated Task",
    "is_completed": true
  }'

# Toggle completion
curl -X POST http://localhost:8000/api/tasks/1/toggle-completion

# Delete task
curl -X DELETE http://localhost:8000/api/tasks/1
```

### Using JavaScript/Fetch

```javascript
// Get all tasks
fetch('http://localhost:8000/api/tasks')
  .then(response => response.json())
  .then(data => console.log(data));

// Create task
fetch('http://localhost:8000/api/tasks', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    title: 'New Task',
    description: 'Task description',
    user_id: 1
  })
})
.then(response => response.json())
.then(data => console.log(data));

// Update task
fetch('http://localhost:8000/api/tasks/1', {
  method: 'PUT',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    title: 'Updated Task',
    is_completed: true
  })
})
.then(response => response.json())
.then(data => console.log(data));

// Delete task
fetch('http://localhost:8000/api/tasks/1', {
  method: 'DELETE'
})
.then(response => response.text())
.then(() => console.log('Task deleted'));

// Toggle completion
fetch('http://localhost:8000/api/tasks/1/toggle-completion', {
  method: 'POST'
})
.then(response => response.json())
.then(data => console.log(data));
```

## Response Format

### Success Response (GET)
```json
{
  "data": [
    {
      "id": 1,
      "title": "Complete project report",
      "description": "Finish the Q2 project report",
      "user_id": 1,
      "is_completed": false,
      "created_at": "2024-05-11T10:30:00Z",
      "updated_at": "2024-05-11T10:30:00Z",
      "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
      }
    }
  ],
  "links": {...},
  "meta": {...}
}
```

### Success Response (POST/PUT)
```json
{
  "id": 1,
  "title": "Complete project report",
  "description": "Finish the Q2 project report",
  "user_id": 1,
  "is_completed": false,
  "created_at": "2024-05-11T10:30:00Z",
  "updated_at": "2024-05-11T10:30:00Z",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}
```

### Error Response
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["The title field is required."],
    "user_id": ["The user_id must exist in users table."]
  }
}
```

## Testing Tools

### 1. Interactive API Tester
Access: `http://localhost:8000/api-tester`

Features:
- Visual interface for testing endpoints
- Pre-populated endpoint list
- Support for all HTTP methods
- JSON request/response formatting
- Query parameter support

### 2. Postman
1. Import the endpoints from `API_DOCUMENTATION.md`
2. Set base URL to `http://localhost:8000`
3. Test each endpoint

### 3. cURL
Use the examples provided above for command-line testing

### 4. Thunder Client / REST Client
Create `.rest` files with your requests

## File Structure

```
4-task-manager/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── Api/
│           │   ├── TaskApiController.php  (NEW)
│           │   └── Schemas.php            (NEW)
│           └── TaskController.php
├── routes/
│   ├── api.php                   (UPDATED)
│   └── web.php                   (UPDATED)
├── config/
│   └── l5-swagger.php            (NEW)
├── public/
│   └── api-tester.html           (NEW)
├── API_DOCUMENTATION.md          (NEW)
└── ...
```

## Troubleshooting

### L5-Swagger Installation Issues

If the composer installation is stuck:
```bash
# Try with a different approach
composer update --no-scripts

# Or skip lock file updates
composer install --prefer-dist
```

### Missing vendor Directory
```bash
# Reinstall dependencies
composer install
```

### Swagger Generation Failed
```bash
# Clear storage cache
php artisan cache:clear

# Try generating again
php artisan swagger:generate
```

## Next Steps

1. ✅ API controller created with full annotations
2. ✅ API routes configured
3. ⏳ Wait for L5-Swagger installation to complete
4. 🔄 Run `php artisan swagger:generate`
5. 📖 Access documentation at `/api/docs`
6. 🧪 Test endpoints using `/api-tester`

## Security Notes

- Currently no authentication is enforced (Bearer token support is configured for future use)
- All authenticated users can manage all tasks
- Consider adding authorization policies for production
- Add rate limiting for API endpoints
- Validate and sanitize all input

## Future Enhancements

- [ ] Add authentication/authorization
- [ ] Add request rate limiting
- [ ] Add caching for frequently accessed endpoints
- [ ] Add API versioning
- [ ] Add webhook support
- [ ] Add GraphQL endpoint
- [ ] Add API key authentication
- [ ] Add request logging and analytics

## Support

For issues or questions:
1. Check `API_DOCUMENTATION.md` for endpoint details
2. Use the interactive API tester at `/api-tester`
3. Review OpenAPI/Swagger definitions at `/api/docs`
4. Check Laravel documentation at https://laravel.com/docs
