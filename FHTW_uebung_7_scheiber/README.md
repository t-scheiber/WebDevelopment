# Student Database (Studentendatenbank) - Web Development Exercise 7 🎓


A student registration and login page in PHP and MySQL. Registration inserts rows into one table, and login reads them back. The code has no edit, delete or search function.

## 🎯 Project Overview

This seventh exercise adds student registration and login to a MySQL table. It covers inserting and reading rows. Editing and deleting are not implemented.

## ✨ Key Features

### Features
- **Register** - `register.php` inserts a student with first name, last name, birth date, email address and password
- **Log in** - The form on the start page checks an email address and password against the table
- **Info pages** - Home, student information and university information, routed with `?menu=`
- **Database connection** - mysqli in `datenbankVerbindung.php`, PDO in `register.php`

## 🛠️ Technologies Used

- **PHP** - Server-side logic and database operations
- **MySQL** - Relational database management
- **PDO/MySQLi** - Database abstraction layer
- **HTML5** - Form structures and semantic markup
- **CSS3** - Styling from `css/footer.css` and inline styles
- **SQL** - Database queries and operations

## 📂 Project Structure

```
FHTW_uebung_7_scheiber/
├── index.php                 # Start page: login form and routing
├── register.php              # Registration form and insert
├── datenbankVerbindung.php   # mysqli connection
├── datenbankKonfiguration.php # reads the database settings from outside the repository
├── sql/studentenliste.sql    # table definition and three demo students
├── inc/                      # header (login), navigation, content, footer
├── sites/                    # home, studenteninfo, hochschulinfo
├── css/footer.css
└── favicon.svg
```

## 🎓 Learning Objectives

### Database Programming
- MySQL database design and normalization
- SQL queries (SELECT, INSERT)
- Prepared statements (used in register.php)
- Database connection management
- Error handling with PDO/MySQLi

### Create and read
- Form handling for data entry
- Reading rows for a login check

### Security notes
- Registration and login use prepared statements.
- Passwords are stored with `password_hash()` and checked with `password_verify()`.
- Names and email addresses are escaped with `htmlspecialchars()` before output. Database errors show a generic message.
- The database settings are read from a file outside the web root or from environment variables (see `datenbankKonfiguration.php`). The repository holds no credentials.
- Registration checks field lengths, the date and the email address. It accepts at most 200 rows and deletes registrations other than the demo rows after 7 days.

## 🗄️ Database Schema

### Table `studentenliste`

`sql/studentenliste.sql` creates the table and adds three fictional demo students (password `demo1234`, for example `anna.beispiel@example.com`). Columns:

- sid (auto increment, inserted as NULL)
- vorname
- nachname
- geburtsdatum
- emailadresse (unique)
- passwort (`password_hash()` output)
- ist_demo (1 for the demo rows)
- registriert_am

## 📋 Features Breakdown

### Register
- Form fields: first name, last name, birth date, email address, password.
- Posts to `register.php`, which inserts the row and shows a success message with a link to the login.

### Log in
- Form fields: email address (`user`) and password (`pwd`) on the start page.
- Prints the name, ID and email address of a matching row.

## 💡 Why This Project Matters

This exercise demonstrates:
- **Full-stack basics**: A PHP page writes to and reads from a MySQL table
- **Database basics**: A table, a prepared INSERT and SELECT queries

## 🎓 Course Context

Part of **Exercise 7** in the Web Development curriculum at **FHTW (Fachhochschule Technikum Wien)**.

---

**Built with PHP & MySQL** 🐘🗄️ | **FHTW Exercise 7** 📚 | **Registration and login** ✨