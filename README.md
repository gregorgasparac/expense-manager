# Expense Manager

### Overview

**Expense Manager** is a web-based application designed to help users track their personal or business expenses. It allows users to add, edit, and delete expenses, categorize them, and view expense summaries. The application is built using modern web technologies including **JavaScript**, **PHP**, **HTML**, and **CSS**, with **MariaDB** as the database and runs on **XAMPP** as the local server environment.

---

### Technologies Used

- **Frontend**: 
  - HTML
  - CSS
  - JavaScript
  
- **Backend**: 
  - PHP
  
- **Database**: 
  - MariaDB (MySQL-compatible database)
  
- **Server Environment**: 
  - XAMPP (Apache, MariaDB, PHP, and Perl)

---

### Installation Guide

#### Prerequisites

- **XAMPP**: You will need to have XAMPP installed on your machine. You can download it from [here](https://www.apachefriends.org/index.html).
- **MariaDB**: It comes bundled with XAMPP, so no separate installation is required.

#### Steps

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/expense-manager.git

### Move Files to XAMPP Directory

2. Copy or move the project folder to the `htdocs` directory in your XAMPP installation. Typically, it is located at:

    ```plaintext
    C:\xampp\htdocs\
    ```

---

### Start XAMPP

3. Open the XAMPP Control Panel and start **Apache** and **MySQL**.

---

### Create the Database

4. Open your browser and go to [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).
5. Create a new database called `expense_manager`.
6. Import the database schema by running the SQL script located in the `db/expense_manager.sql` file.

---

### Configure the Database Connection

7. Open the `config.php` file in the root of the project and update the database credentials:

    ```php
    <?php
    $host = 'localhost';
    $db = 'expense_manager';
    $user = 'root'; // Default XAMPP user is 'root'
    $password = ''; // Leave blank for XAMPP default setup
    ?>
    ```

---

### Access the Application

8. Open your browser and go to [http://localhost/expense-manager](http://localhost/expense-manager).
