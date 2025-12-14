# Smart Inventory Management System

A simple fullstack inventory management web application built with **Laravel 11**.  
This project demonstrates authentication, role-based access control, and CRUD operations.

---

## ✨ Features
- Authentication (Login & Register)
- Role-based access (Admin & Staff)
- Item management (CRUD)
- Pagination
- Seeder for dummy data
- Admin-only delete action
- Clean and structured codebase

---

## 🛠️ Tech Stack
- Backend: Laravel 11
- Frontend: Blade + Tailwind CSS
- Database: MySQL
- Authentication: Laravel Breeze
- Authorization: Custom Role Middleware

---

## 👤 User Roles
| Role | Access |
|----|----|
Admin | Full access, can delete items |
Staff | Manage items (view, create, edit) |

---

## 🚀 Installation & Setup

```bash
git clone https://github.com/yourusername/smart-inventory.git
cd smart-inventory
composer install
cp .env.example .env
php artisan key:generate

Configure database in .env, then run:

php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve

🔐 Demo Accounts
Role	Email	          Password
Admin	admin@example.com password
Staff	staff@example.com password

📂 Project Structure
app/
 ┣ Http/
 ┃ ┣ Controllers/
 ┃ ┣ Middleware/
database/
 ┣ migrations/
 ┣ seeders/
resources/
 ┣ views/
 ┃ ┣ items/
routes/
 ┣ web.php

 🧠 What I Learned

Implementing role-based access control

Structuring Laravel applications cleanly

Securing routes with middleware

Building real-world CRUD features

Using seeders for demo-ready applications

📌 Author

Muhamad Rifansyah
S1 Sistem Informasi


---

## 💾 COMMIT README
```bash
git add README.md
git commit -m "docs: add professional project README"
