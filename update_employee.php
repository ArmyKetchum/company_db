<?php
include "db_connect.php";

if (isset($_POST["update_employee"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $department_id = $_POST["department_id"];
    $conn->query("UPDATE Employees SET name='$name', age=$age, email='$email', department_id=$department_id WHERE id=$id");
}

$conn->close();
header("Location: list_employees.php");
exit();
?>