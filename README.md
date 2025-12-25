# Laravel Blog System (Admin & User Panel)

A simple **Laravel-based Blog Application** with:
- Public blog posts
- User registration & login (session-based)
- User post & comment management
- Admin dashboard to manage users, posts, and comments

This project is built **without Laravel default auth**, using **custom session-based authentication**, ideal for learning core Laravel concepts.

---

## 📌 Features

### 👤 User Side
- User Registration with profile image
- User Login / Logout (Session-based)
- Create, Edit, Delete Posts
- View All Posts with Pagination
- Add, Edit, Delete Comments
- View User Profile

### 🛡️ Admin Panel
- Admin Login / Logout
- Admin Dashboard with statistics
- View & Delete Users
- View & Delete Posts
- View & Delete Comments
- Admin Authentication Middleware

---

## 🧱 Tech Stack

- **Laravel**
- **Blade Templates**
- **MySQL**
- **Bootstrap 5**
- **Session-based Authentication**
- **Eloquent ORM**

---

## 📁 Project Structure

```text
resources/
├── views/
│   ├── admin/
│   │   ├── auth/
│   │   │   └── login.blade.php
│   │   ├── comments/
│   │   │   └── index.blade.php
│   │   ├── posts/
│   │   │   └── index.blade.php
│   │   ├── users/
│   │   │   └── index.blade.php
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   └── dashboard.blade.php
│   ├── post/
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   ├── postuser/
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   ├── index.blade.php
│   │   ├── login.blade.php
│   │   └── show.blade.php
│   ├── layouts/
│   │   └── app.blade.php
│    
```

## 🧑‍💻 Controllers

### Admin Controllers
- AdminAuthController  
- DashboardController  
- AdminPostController  
- AdminUserController  
- AdminCommentController  

### User Controllers
- PostUserController  
- PostController  
- CommentController  

---

## 🔐 Authentication System

### User Authentication
- Custom session-based authentication  
- Session key: `user`

### Admin Authentication
- Separate `admins` table  
- Session key: `admin`  
- Protected using `AdminAuth` middleware  

---

## 🧩 Middleware

### AdminAuth Middleware
**Location:**  
`app/Http/Middleware/AdminAuth.php`

**Purpose:**
- Restricts access to admin routes  
- Allows access only to logged-in admins  

---

## 🗃️ Database Design

### Tables
- `admins`
- `post_users`
- `posts`
- `comments`

### Relationships
- PostUser → hasMany Posts  
- PostUser → hasMany Comments  
- Post → belongsTo PostUser  
- Post → hasMany Comments  
- Comment → belongsTo Post  
- Comment → belongsTo PostUser  

---

## 📸 File Uploads
- **Profile Images:** `public/uploads/profile/`  
- **Post Images:** `public/uploads/posts/`  

---

## ⚙️ Installation Guide

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve


## 🔑 Admin Setup

Insert an admin record manually into the database:

```sql
INSERT INTO admins (name, email, password)
VALUES ('Admin', 'admin@example.com', '1234');

## ⚠️ Security Notice

⚠️ **Important:**  
This project is for **learning purposes only**.

- Passwords are stored in **plain text**
- Session-based authentication only
- **Not recommended for production use**

### For Production Use
- Use password hashing (`bcrypt`)
- Use Laravel’s built-in authentication system
- Implement CSRF protection and authorization policies

---

## 📚 Learning Outcomes

By working on this project, you will learn:
- Laravel MVC Architecture
- Custom Authentication using Sessions
- Middleware Creation and Usage
- Eloquent ORM & Model Relationships
- File Upload Handling
- Pagination and Form Validation
- Admin Dashboard Logic

---

## ⭐ Contribution

This project is intended for **educational use**.  
Feel free to fork, improve, or extend it for practice.

---

## 📝 License

This project is open-source and available for learning and personal use.
