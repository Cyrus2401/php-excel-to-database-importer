<?php

    /**
     * php-excel-to-database-importer
     * 
     * Parses a .xlsx Excel file and imports each row
     * into a MySQL database table using PDO.
     */

    // Display all PHP errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once 'src/SimpleXLSX.php';
    require_once 'config.php';

    // Database connection via PDO
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if ($xlsx = SimpleXLSX::parse('fileExample.xlsx')) {

        foreach ($xlsx->rows() as $key => $value) {

            if ($key > 0) {

                $pdo->beginTransaction();

                $sql = "INSERT INTO infos (firstname, lastname, gender, country, old, date, matricule)
                        VALUES (:firstname, :lastname, :gender, :country, :old, :date, :matricule)";

                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(":firstname", $value[1]);
                $stmt->bindParam(":lastname",  $value[2]);
                $stmt->bindParam(":gender",    $value[3]);
                $stmt->bindParam(":country",   $value[4]);
                $stmt->bindParam(":old",       $value[5]);
                $stmt->bindParam(":date",      $value[6]);
                $stmt->bindParam(":matricule", $value[7]);

                if ($stmt->execute()) {
                    $pdo->commit();
                } else {
                    $pdo->rollback();
                }
            }
        }

        echo "Save Successfully !";

    } else {
        echo "No Save !";
    }

?>