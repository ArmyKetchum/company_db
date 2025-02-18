<?php
include "db_connect.php";

if (isset($_POST["delete_employee"])) {
    $id = $_POST["id"];
    $conn->query("DELETE FROM Employees WHERE id=$id");
}

$conn->close();
header("Location: list_employees.php");
exit();
?>