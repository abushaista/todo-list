
# ✅ Laravel 12 Todo List API

A clean and RESTful **Todo List API** built with Laravel 12. Manage tasks using a modern JSON API—ready for frontend consumption (React, Vue, mobile apps, etc).

---

## 📦 Tech Stack

- **Laravel 12**
- **PHP 8.2+**
- **MySQL**
- **RESTful JSON API**

---

## 🚀 Features

- Create, read, update, and delete todos
- Mark todos as complete or pending
- Filter todos by status
- JSON responses with validation errors
- Structure ready for frontend integration
- Optional: add Sanctum for API token auth

---

## ⚙️ Installation

```bash
# Clone the repository
git clone https://github.com/abushaista/todo-list  
cd todo-list

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure your .env DB settings and run migrations
php artisan migrate

# Serve the application
php artisan serve
```

Default API base URL: `http://localhost:8000/api`

---

## 🧪 API Endpoints

| Method | Endpoint          | Description          |
|--------|-------------------|----------------------|
| GET    | `/api/todos`      | Get all todos        |
| GET    | `/api/todos/{id}` | Get a specific todo  |
| POST   | `/api/todos`      | Create a new todo    |
| PUT    | `/api/todos/{id}` | Update a todo        |
| DELETE | `/api/todos/{id}` | Delete a todo        |

---

## 📤 Sample JSON Requests

### POST `/api/todo`

```json
{
    "title": "add feature",
    "due_date":"2025-08-01",
    "priority":"high"
}
```

### PUT `/api/todo/1`

```json
{
    "assignee": "harry",
    "time_tracked": 1,
    "status": "pending"
}
```

---

## 🧪 Testing with Postman

You can test the API using Postman or Curl:

```bash
curl -X POST http://localhost:8000/api/todo      -H "Content-Type: application/json"      -d '{"title":"New Task","assignee":"harry","due_date": "2025-08-01", "priority":"high"}'
```

> Need a Postman collection? Let me know and I’ll generate one for you.

---

## 🗃️ Folder Structure (API-related)

```
app/
├── Models/
│   └── Todo.php
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── TodoController.php
│   ├── Requests/
│       ├── StoreTodoRequest.php
│       └── UpdateTodoRequest.php
|── Contracts/
|   ├── TodoExportInterface.php
│   └── TodoServiceInterface.php
|── Services/
|   ├── TodoExport.php
│   └── TodoService.php
|
routes/
├── api.php

database/
├── migrations/
│   └── xxxx_xx_xx_create_todos_table.php
```

---

## 🔒 Optional: Authentication

You can add token-based auth using Laravel Sanctum:

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

Secure routes by adding `auth:sanctum` middleware.


---

## 👏 Contributing

Pull requests and issues are welcome. Please fork and submit a PR!
