# 🔐 PHP JWT Auth System with Role-Based Access (Admin & Member)

Sistem autentikasi backend menggunakan **PHP**, **JWT**, dan **MySQL** yang mendukung **Role-Based Access Control (RBAC)** dengan middleware.

---

## 🚀 Fitur Utama

- Login dan Register menggunakan **JWT**
- **Role: Admin & Member**
- Middleware untuk validasi JWT dan peran
- CRUD untuk data user
- Konfigurasi database melalui `.env`
- Struktur kode modular dan terorganisir

---

## 🛠️ Instalasi

### 1. Clone Repository
```bash
git https://github.com/ashari-dev/latihan-php.git
cd latihan-php
```

### 2. Install Dependency
```bash
composer install
```

### 3. Buat File `.env`
```env
DB_HOST=localhost
DB_NAME=auth_system
DB_USER=root
DB_PASS=password123
JWT_SECRET=your_jwt_secret
```

### 4. Setup Database
```sql
CREATE DATABASE auth_system;

USE auth_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'member') DEFAULT 'member',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## ▶️ Cara Menjalankan

Jalankan server lokal dengan:
```bash
php -S localhost:8000 -t public
```

---

## 📦 API Endpoint

### 🔐 Auth
| Method | Endpoint     | Keterangan     |
|--------|--------------|----------------|
| POST   | `/login`     | Login dan mendapatkan JWT |
| POST   | `/register`  | Register user baru (default role = member) |

### 👥 User Management

| Method | Endpoint       | Akses | Keterangan              |
|--------|----------------|-------|--------------------------|
| GET    | `/users`       | Semua| Lihat semua user        |
| POST   | `/users`       | Admin| Tambah user baru        |
| GET    | `/users/{id}`  | Semua| Lihat user berdasarkan ID |
| PUT    | `/users/{id}`  | Admin| Edit user berdasarkan ID |
| DELETE | `/users/{id}`  | Admin| Hapus user berdasarkan ID |


---

## 🔒 Authorization

Gunakan header berikut untuk mengakses endpoint yang memerlukan autentikasi:

```
Authorization: Bearer <your_jwt_token>
```


---

## ✅ Role Permissions

| Role   | Akses                    |
|--------|--------------------------|
| Admin  | Full CRUD user           |
| Member | Hanya melihat user (GET) |

---

## 📬 Contoh Request (Postman / cURL)

### Login
```bash
curl -X POST http://localhost:8000/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com", "password":"admin"}'
```

### GET All Users
```bash
curl http://localhost:8000/users \
  -H "Authorization: Bearer <your_token>"
```

