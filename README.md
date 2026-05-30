# PHP Excel to Database Importer

Lightweight PHP utility to parse `.xlsx` Excel files and bulk-import their rows directly into a MySQL database with transaction support.

---

## Description

**PHP Excel to Database Importer** automates the import of Excel spreadsheet data into MySQL. It reads `.xlsx` files row by row, maps each column to database fields, and inserts records using PDO with transaction support for data integrity. Designed for simplicity and easy customization to any table structure.

> **Note:** This tool supports `.xlsx` files only. Legacy `.xls` format is not supported.

---

## Features

- Parse `.xlsx` Excel files
- Bulk import rows into MySQL database
- PDO-based database connection with error handling
- Transaction support for data integrity
- Easy configuration and customization
- Ready-to-use example table schema

---

## Technologies

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![PDO](https://img.shields.io/badge/PDO-grey?style=for-the-badge)

---

## Requirements

- **PHP** ≥ 5.3
- **MySQL** Server
- **PHP XML Extension** (required for SimpleXLSX library)
- **PDO MySQL Driver**

---

## Installation

Clone the repository:

```bash
git clone https://github.com/Cyrus2401/php-excel-to-database-importer.git
cd php-excel-to-database-importer
```

---

## Configuration

### 1. Database Credentials

Copy the example configuration file:

```bash
cp config.example.php config.php
```

Edit `config.php` with your database credentials:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
```

> ⚠️ `config.php` is listed in `.gitignore` — your credentials will never be pushed to version control.

### 2. Database Table

Create your target table in MySQL. Example schema (matching the default script):

```sql
CREATE TABLE infos (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100),
    lastname  VARCHAR(100),
    gender    VARCHAR(20),
    country   VARCHAR(100),
    old       INT,
    date      DATE,
    matricule VARCHAR(100)
);
```

### 3. Excel File

Place your `.xlsx` file in the project root directory. Update the filename in `index.php`:

```php
if ($xlsx = SimpleXLSX::parse('yourfile.xlsx'))
```

---

## Usage

Run the import script using PHP's built-in server or your web server (Apache, WAMP, XAMPP):

```bash
php -S localhost:8000
```

Open your browser at:

```
http://localhost:8000/index.php
```

On successful import, you will see:

```
Save Successfully !
```

If an error occurs, you will see:

```
No Save !
```

---

## Project Structure

```
php-excel-to-database-importer/
├── index.php              # Main import script
├── config.example.php     # Configuration template
├── config.php             # Your database credentials (gitignored)
├── src/
│   └── SimpleXLSX.php    # Excel parser library
├── README.md              # This file
└── fileExample.xlsx       # Your Excel file to import
```

---

## Customization

To adapt the script to your table structure:

1. Update the SQL query in `index.php`:

```php
$sql = "INSERT INTO your_table (col1, col2, col3, ...)
        VALUES (:col1, :col2, :col3, ...)";
```

2. Update the parameter bindings to match your columns:

```php
$stmt->bindParam(":col1", $value[1]);
$stmt->bindParam(":col2", $value[2]);
```

The array index (`$value[0]`, `$value[1]`, etc.) corresponds to each column in your Excel file, starting from column 0.

---

## License

This project is licensed under the MIT License.
