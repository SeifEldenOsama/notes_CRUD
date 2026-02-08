# Notes CRUD Application

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-orange.svg)](https://www.mysql.com/)

The **Notes CRUD Application** is a professional, database-driven web solution for personal note management. It demonstrates a robust implementation of full-stack web development, focusing on secure **CRUD (Create, Read, Update, Delete)** operations within a user-authenticated environment.

---

## 🌟 Key Features

| Feature | Description |
| :--- | :--- |
| **Secure Authentication** | User sign-up and login system with session management. |
| **Rich Text Editing** | Integrated CKEditor for formatted note-taking. |
| **Responsive Design** | Clean interface built with Bootstrap for all device sizes. |
| **Persistent Storage** | Reliable data management using MySQL and PDO. |

---

## 🏗️ Technical Stack

- **Backend:** PHP (PDO for secure database access)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **Editor:** CKEditor 4/5

---

## 📂 Project Structure

```text
notes_CRUD/
├── backend/
│   ├── functions/        # Core business logic
│   ├── connection.php    # Database connection logic
│   ├── config.php.example # Configuration template
│   └── ...               # CRUD operation handlers
├── css/                  # Custom stylesheets
├── crud.sql              # Database schema
├── index.php             # Application dashboard
└── README.md             # Project documentation
```

---

## 🚀 Getting Started

### 1. Prerequisites
- Web server (Apache/Nginx)
- PHP 7.4 or higher
- MySQL 5.7 or higher

### 2. Installation Steps
1. **Clone the Repository:**
   ```bash
   git clone https://github.com/SeifEldenOsama/notes_CRUD.git
   cd notes_CRUD
   ```
2. **Database Setup:**
   - Create a database named `crud`.
   - Import `crud.sql` into your MySQL server.
3. **Configuration:**
   - Copy `backend/config.php.example` to `backend/config.php`.
   - Update the database credentials in `backend/config.php`.
4. **Deployment:**
   - Move the project folder to your web server's root directory.
   - Access via `http://localhost/notes_CRUD`.

---
## 👥 Team

Developed by:
- SeifElden Osama Hosney
- Sama NigmEldin
- Habiba Ashraf
- Mohamed Badr
- Esraa Ahmed
- Mohamed AbdAlwanis
