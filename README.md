# php-excel-to-database-importer

=**PHP tool that parses `.xlsx` Excel files and bulk-imports their rows directly into a MySQL database**.

---

## Description

`php-excel-to-database-importer` is a minimal PHP script designed to automate the import of Excel data into a MySQL database. It reads a `.xlsx` file row by row, maps each column to a database field, and inserts the records using PDO with transaction support for data integrity. Simple to set up and easy to adapt to any table structure.

> **Note:** This tool only supports `.xlsx` files. Legacy `.xls` format is not supported.

---

## Tech Stack

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

---

## Installation

Clone the repository:

```bash
git clone https://github.com/Cyrus2401/php-excel-to-database-importer.git
cd php-excel-to-database-importer
```

---

## Configuration

1. **Database** — Create a MySQL database and update the credentials in `index.php`:

```php
$pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_user", "your_password");
```

2. **Table** — Make sure your target table exists. Example schema matching the default script:

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

3. **Excel file** — Place your `.xlsx` file in the project root and update the filename in `index.php`:

```php
if ($xlsx = SimpleXLSX::parse('yourfile.xlsx'))
```

---

## Usage

Run the script via your local PHP server or a web server (e.g. Apache / WAMP / XAMPP):

```bash
php -S localhost:8000
```

Then open your browser at:

```
http://localhost:8000/index.php
```

If the import succeeds, you will see:

```
Save Successfully !
```

---

## License

This project is open source and available under the [MIT License](LICENSE).
