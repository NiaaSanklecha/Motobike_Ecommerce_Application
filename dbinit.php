<?php
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_HOST', 'localhost');

    $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)
        OR die('Could not connect to MySQL: ' . mysqli_connect_error());
    mysqli_set_charset($dbc, 'utf8');

    function prepare_string($dbc, $string) {
        $string_trimmed = trim($string);
        $string = mysqli_real_escape_string($dbc, $string_trimmed);
        return $string;
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS motorbike";
    if ($dbc->query($sql) === TRUE) {
        //echo "Database created successfully";
    } else {
        //echo "Error creating database: " . $dbc->error;
    }

        // Select database
    $dbc->select_db("motorbike");

    // Create table
    $sql = "CREATE TABLE IF NOT EXISTS motorbike (
        motorbikeID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        motorbikeName VARCHAR(255) NOT NULL,
        motorbikeDescription TEXT,
        quantityAvailable INT(6) NOT NULL,
        motorbikePrice DECIMAL(10, 2) NOT NULL,
        motorbikeImage LONGBLOB NOT NULL
    )";
    if ($dbc->query($sql) === TRUE) {
        //echo "Table handbags created successfully";
    } else {
        //echo "Error creating table: " . $dbc->error;
    }

    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(50) NOT NULL,
        lastName VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if ($dbc->query($sql) === TRUE) {
        //echo "Table users created successfully";
    } else {
        //echo "Error creating table: " . $link->error;
    }
?>