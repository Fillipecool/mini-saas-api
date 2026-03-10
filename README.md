# Mini SaaS API — Client & Notification Management

This project is a **RESTful API built with Laravel** that simulates a small SaaS platform for managing clients, tasks, notifications, and financial transactions.

The goal of this project is to demonstrate **backend architecture, Dockerized environments, API design, authentication, and automated testing**.

---

## 🚀 Features

* User authentication
* Client management
* Task management
* Notification system
* Simple financial transaction tracking
* Automated tests
* Fully Dockerized development environment

---

## 🧱 Tech Stack

* **Laravel**
* **PHP**
* **PostgreSQL**
* **Redis**
* **Docker**
* **PHPUnit / Pest (tests)**

---

## 📦 Project Architecture

```
Client
  ↓
Laravel API
  ↓
PostgreSQL Database
  ↓
Redis (Cache / Queue)
```

---

## ⚙️ Running the Project

### 1️⃣ Clone the repository

```
git clone https://github.com/Fillipecool/mini-saas-api.git
cd mini-saas-api
```

### 2️⃣ Start the containers

```
docker compose up -d
```

### 3️⃣ Install Laravel

```
docker compose exec app composer create-project laravel/laravel .
```

### 4️⃣ Run migrations

```
docker compose exec app php artisan migrate
```

## 🔐 Authentication Endpoints

```
POST /register
POST /login
POST /logout
GET  /me
```

---

## 👥 Clients

```
POST /clients
GET  /clients
GET  /clients/{id}
PUT  /clients/{id}
DELETE /clients/{id}
```

---

## 🔔 Notifications

```
POST /notifications
GET  /notifications
```

---

## 📋 Tasks

```
POST /tasks
GET  /tasks
PUT /tasks/{id}
DELETE /tasks/{id}
```

---

## 💰 Financial Transactions

```
POST /transactions
GET /transactions
```

---

## 🧪 Running Tests

```
docker compose exec app php artisan test
```

or

```
vendor/bin/phpunit
```

---

## 📌 Project Status

🚧 Under development

Current progress:

* [x] Docker environment setup
* [x] Authentication API
* [x] Client management
* [ ] Notification system
* [ ] Task management
* [ ] Financial module
* [ ] Automated tests

---

## 📖 Purpose

This project was created as a **portfolio backend project** to demonstrate:

* REST API design
* Laravel backend architecture
* Docker-based development environments
* Testing practices
* SaaS-style application structure
