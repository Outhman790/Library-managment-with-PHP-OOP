## 📚 Library Management System (PHP OOP)

This project is built to help automate the operations of a **public media library (médiathèque)**. The application allows members to borrow, reserve, and explore various documents and media types offered by the institution.

---

### 🏛️ Project Context

A large public media library wants to computerize its book borrowing and reservation operations. It provides access to a wide variety of documents including:

* Books
* Novels
* Research papers
* Magazines
* CDs, DVDs
* Video cassettes

Key Functional Requirements:

* Multiple **types of members** (students, employees, housewives, etc.)
* Each member can borrow **up to 3 items**
* Mandatory **reservation before borrowing**, valid for 24 hours only
* **User accounts** with nickname, password, and creation date
* Borrowing includes tracking borrow date and return date
* Media items are uniquely identified, even if they are copies of the same title

### ⚖️ Management Rules

* Max 3 active reservations/borrowings per member
* Reservation must be done before borrowing
* Torn documents cannot be reserved or borrowed
* Only available and unreserved documents can be reserved
* Borrowing period is 15 days max
* Overdue returns add a penalty
* Over 3 penalties = account lock
* All operations require login/authentication

---

### 🚀 Features

* 🔐 User Registration & Login
* 📖 Borrow & Return Management
* ⏳ Reservation with Expiry Logic
* 📅 Penalty Tracking & Account Blocking
* 🧑‍💼 Admin Panel for Back-Office Operations
* 📋 User Profile Management
* 📂 MVC-inspired File Structure
* ⏲️ Windows-based Cron Automation

---

### 🛠️ Tech Stack

* **Backend:** PHP (OOP)
* **Frontend:** HTML, CSS, Bootstrap 5
* **Database:** MySQL
* **Automation:** VBScript + Batch (Windows Cron Simulation)

---

### 📁 Project Structure

```
.
├── admin/              → Admin dashboard pages
├── classes/            → Core logic (DB, CRUD, controllers)
├── AutoScript/         → Return checker scripts
├── .vscode/            → IDE configs
├── index.php           → Homepage
├── myProfile.php       → User profile management
└── LICENSE             → Project license
```

---

### ⚙️ Installation

1. **Clone the project**

```bash
git clone https://github.com/yourusername/Library-management-with-PHP-OOP.git
```

2. **Import the Database**

* Use `phpMyAdmin`
* Import the SQL dump if available or create tables manually

3. **Configure DB Access**

Update `/classes/dbConnect.class.php`:

```php
private $host = 'localhost';
private $db = 'your_database';
private $user = 'root';
private $pass = '';
```

4. **Run on Local Server**

Use **XAMPP**, **Laragon**, or similar and access:

```
http://localhost/Library-managment-with-PHP-OOP/
```

---

### 📸 Screenshots

Homepage:
![Screenshot 2025-07-03 at 04-01-33 Homepage](https://github.com/user-attachments/assets/188d8040-4295-4696-afb0-5c90155f90c8)
All items ( take reservation ):
![image](https://github.com/user-attachments/assets/496d8008-b095-4850-94f0-0e06ce3d89b6)
My reservations: 
![image](https://github.com/user-attachments/assets/893e2710-7d6b-4d5b-a472-857754fca7e9)
My borrowings: 
![image](https://github.com/user-attachments/assets/61abcb32-e5af-4949-a51d-b9daa04f9cad)
My profile ( update example ): 
![image](https://github.com/user-attachments/assets/f1ad332a-77a8-482b-98ef-cbe8fc21f7ff)





---

