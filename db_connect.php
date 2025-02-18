<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "company_db";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $database");
$conn->select_db($database);

$conn->query("CREATE TABLE IF NOT EXISTS Departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(50) NOT NULL UNIQUE
)");

$conn->query("CREATE TABLE IF NOT EXISTS Employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    department_id INT NOT NULL,
    FOREIGN KEY (department_id) REFERENCES Departments(id) ON DELETE CASCADE
)");
?>