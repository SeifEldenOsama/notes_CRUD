# Notes CRUD Application

## 1. Project Overview

The **Notes CRUD Application** is a complete, database-driven web solution for personal note management. It is designed to demonstrate a fundamental understanding of full-stack web development, focusing on the essential **CRUD (Create, Read, Update, Delete)** operations within a secure, user-authenticated environment.

The application is built using a traditional **PHP and MySQL** stack, providing a robust and widely-used architecture for web services. It features a clean, responsive interface powered by Bootstrap and integrates a rich text editor for enhanced note-taking capabilities.

## 2. Features

The application provides the following core functionalities:

| Feature | Description | Implementation Details |
| :--- | :--- | :--- |
| **User Authentication** | Secure sign-up and login system to ensure notes are private and tied to a specific user account. | `login.php`, `signup.php`, `register.php`, `logout.php` |
| **Create Note (C)** | Allows logged-in users to create new notes with rich text content. | `submit.php`, CKEditor integration |
| **Read Notes (R)** | Displays a dashboard view of all notes belonging to the authenticated user. | `index.php`, `functions/main.php` |
| **Update Note (U)** | Provides functionality to edit and save changes to existing notes. | `edit.php` |
| **Delete Note (D)** | Allows users to permanently remove notes from the database. | `delete.php` |
| **Database Management** | Uses MySQL for persistent storage, with connection handled securely via PHP Data Objects (PDO). | `connection.php`, `crud.sql` |

## 3. Technical Stack

The project leverages the following technologies:

| Component | Technology | Role |
| :--- | :--- | :--- |
| **Backend Logic** | PHP | Handles server-side processing, routing, and business logic. |
| **Database** | MySQL | Relational database for storing user and note data. |
| **Database Access** | PDO (PHP Data Objects) | Provides a secure, consistent interface for connecting to the database. |
| **Frontend Styling** | HTML, CSS, Bootstrap | Provides the structure, styling, and responsive design for the user interface. |
| **Rich Text Editing** | CKEditor | Integrated to allow users to format their notes with various text styles. |

## 4. Installation and Setup

### Prerequisites
*   A web server environment (e.g., XAMPP, WAMP, MAMP, or a dedicated LAMP stack) with **PHP** and **MySQL** installed.
*   A web browser.

### Setup Steps
1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/SeifEldenOsama/notes_CRUD.git
    cd notes_CRUD
    ```
2.  **Database Configuration:**
    *   Create a new MySQL database named `crud`.
    *   Import the database schema using the provided SQL file:
        ```bash
        mysql -u your_user -p crud < crud.sql
        ```
    *   **Update Connection Details:** Review and update the database credentials in `backend/connection.php` if your local setup differs from the default (e.g., if you have a password set for the `root` user).
3.  **Deployment:**
    *   Place the entire `notes_CRUD` folder into your web server's document root (e.g., `htdocs` or `www`).
4.  **Access the Application:**
    *   Open your web browser and navigate to the project's URL (e.g., `http://localhost/notes_CRUD/`).

## 5. Repository Structure

```
notes_CRUD/
├── backend/
│   ├── functions/
│   │   └── main.php          # Core functions for notes and user management
│   ├── connection.php        # Database connection setup
│   ├── delete.php            # Handles note deletion
│   ├── edit.php              # Handles note updates
│   ├── login.php             # Handles user login logic
│   ├── logout.php            # Handles user logout
│   ├── register.php          # Handles user registration logic
│   └── submit.php            # Handles new note creation
├── CSS/                      # Custom CSS files
├── crud.sql                  # Database schema and initial data
├── index.php                 # Main application interface (Note Dashboard)
└── README.md                 # This file
```

## 6. Team

This project was developed by the following team members:
*   SeifElden Osama Hosney
*   Sama NigmEldin
*   Habiba Ashraf
*   Mohamed Badr
*   Esraa Ahmed
*   Mohamed AbdAlwanis
