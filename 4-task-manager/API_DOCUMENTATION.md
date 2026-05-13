# Task Manager API Documentation

## Overview
This is the API documentation for the Task Manager application. The API provides endpoints for managing tasks and users with full CRUD operations, filtering, and sorting capabilities.

## Base URL
```
http://localhost:8000/api
```

## Authentication
Currently, the API does not require authentication, but Bearer token support is configured for future use.

---

## Endpoints

### Tasks

#### 1. Get All Tasks
**Endpoint:** `GET /api/tasks`

**Description:** Retrieve a paginated list of tasks with optional filtering and sorting.

**Query Parameters:**
- `search` (string, optional): Search by task title or description
- `status` (string, optional): Filter by status - `completed` or `pending`
- `sort` (string, optional): Sort by - `latest`, `oldest`, or `title`
- `page` (integer, optional): Page number for pagination (default: 1)

**Response:**
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

**Status:** 200 OK

---

#### 2. Get Task by ID
**Endpoint:** `GET /api/tasks/{id}`

**Description:** Retrieve a single task by ID.

**Parameters:**
- `id` (integer, required): Task ID

**Response:**
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

**Status:** 200 OK

**Error Responses:**
- 404 Not Found: Task not found

---

#### 3. Create Task
**Endpoint:** `POST /api/tasks`

**Description:** Create a new task.

**Request Body:**
```json
{
  "title": "Complete project report",
  "description": "Finish the Q2 project report",
  "user_id": 1,
  "is_completed": false
}
```

**Required Fields:**
- `title` (string): Task title
- `user_id` (integer): ID of the user to assign the task to

**Optional Fields:**
- `description` (string): Task description
- `is_completed` (boolean): Task completion status

**Response:**
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

**Status:** 201 Created

**Error Responses:**
- 422 Unprocessable Entity: Validation failed

---

#### 4. Update Task
**Endpoint:** `PUT /api/tasks/{id}`

**Description:** Update an existing task.

**Parameters:**
- `id` (integer, required): Task ID

**Request Body:**
```json
{
  "title": "Updated task title",
  "description": "Updated description",
  "user_id": 2,
  "is_completed": true
}
```

**Optional Fields:** All fields are optional

**Response:**
```json
{
  "id": 1,
  "title": "Updated task title",
  "description": "Updated description",
  "user_id": 2,
  "is_completed": true,
  "created_at": "2024-05-11T10:30:00Z",
  "updated_at": "2024-05-12T15:45:00Z",
  "user": {
    "id": 2,
    "name": "Jane Smith",
    "email": "jane@example.com"
  }
}
```

**Status:** 200 OK

**Error Responses:**
- 404 Not Found: Task not found
- 422 Unprocessable Entity: Validation failed

---

#### 5. Delete Task
**Endpoint:** `DELETE /api/tasks/{id}`

**Description:** Delete a task permanently.

**Parameters:**
- `id` (integer, required): Task ID

**Response:** Empty response

**Status:** 204 No Content

**Error Responses:**
- 404 Not Found: Task not found

---

#### 6. Toggle Task Completion Status
**Endpoint:** `POST /api/tasks/{id}/toggle-completion`

**Description:** Toggle the completion status of a task.

**Parameters:**
- `id` (integer, required): Task ID

**Response:**
```json
{
  "id": 1,
  "title": "Complete project report",
  "description": "Finish the Q2 project report",
  "user_id": 1,
  "is_completed": true,
  "created_at": "2024-05-11T10:30:00Z",
  "updated_at": "2024-05-12T16:00:00Z",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}
```

**Status:** 200 OK

**Error Responses:**
- 404 Not Found: Task not found

---

## Example Requests

### Using cURL

**Get all tasks:**
```bash
curl http://localhost:8000/api/tasks
```

**Get completed tasks:**
```bash
curl "http://localhost:8000/api/tasks?status=completed&sort=latest"
```

**Search tasks:**
```bash
curl "http://localhost:8000/api/tasks?search=report"
```

**Create a new task:**
```bash
curl -X POST http://localhost:8000/api/tasks \
  -H "Content-Type: application/json" \
  -d '{
    "title": "New Task",
    "description": "Task description",
    "user_id": 1
  }'
```

**Update a task:**
```bash
curl -X PUT http://localhost:8000/api/tasks/1 \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Updated Task",
    "is_completed": true
  }'
```

**Delete a task:**
```bash
curl -X DELETE http://localhost:8000/api/tasks/1
```

**Toggle task completion:**
```bash
curl -X POST http://localhost:8000/api/tasks/1/toggle-completion
```

---

## Error Handling

All error responses follow a consistent format:

```json
{
  "message": "Error description",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

**Common HTTP Status Codes:**
- `200 OK`: Successful GET or PUT request
- `201 Created`: Successful POST request
- `204 No Content`: Successful DELETE request
- `400 Bad Request`: Malformed request
- `404 Not Found`: Resource not found
- `422 Unprocessable Entity`: Validation error
- `500 Internal Server Error`: Server error

---

## Installation & Setup

### Prerequisites
- PHP 8.3+
- Composer
- Laravel 13

### Setup Instructions

1. **Install dependencies:**
```bash
composer install
npm install
```

2. **Configure environment:**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Setup database:**
```bash
php artisan migrate
php artisan db:seed
```

4. **Generate Swagger documentation** (after L5-Swagger is installed):
```bash
php artisan swagger:generate
```

5. **Access Swagger UI:**
Visit `http://localhost:8000/api/docs` in your browser

---

## Testing the API

### Using Postman

1. Import the endpoints from this documentation
2. Set the base URL to `http://localhost:8000`
3. Create requests for each endpoint
4. Test with various query parameters and request bodies

### Using Thunder Client or REST Client

Create a `.rest` file with your requests:

```rest
### Get all tasks
GET http://localhost:8000/api/tasks

### Get completed tasks
GET http://localhost:8000/api/tasks?status=completed

### Create task
POST http://localhost:8000/api/tasks
Content-Type: application/json

{
  "title": "New Task",
  "description": "Task description",
  "user_id": 1
}
```

---

## OpenAPI Specification

The API uses OpenAPI 3.0 specification for documentation. The full specification is available at:
- **JSON**: `http://localhost:8000/api/documentation` (Swagger JSON)
- **UI**: `http://localhost:8000/api/docs` (Swagger UI)

---

## Notes

- All timestamps are in UTC (ISO 8601 format)
- Pagination defaults to 10 items per page
- Search is case-insensitive
- Tasks are soft-deleted by default (can be configured)
- User IDs must exist in the database when creating/updating tasks

---

## Support

For issues or questions, please refer to the main project README or contact support.
