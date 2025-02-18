<?php
include "db_connect.php";

if (isset($_POST["add_department"])) {
    $department_name = $_POST["department_name"];
    $conn->query("INSERT INTO Departments (department_name) VALUES ('$department_name')");
}

if (isset($_POST["add_employee"])) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $department_id = $_POST["department_id"];
    $conn->query("INSERT INTO Employees (name, age, email, department_id) VALUES ('$name', $age, '$email', $department_id')");
}

$departments = $conn->query("SELECT * FROM Departments");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Data</title>
    <style>
        body {
            padding: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input, select, button {
            margin: 5px 0;
            padding: 8px;
            width: 100%;
            max-width: 300px;
        }
        button {
            width: auto;
        }
    </style>
</head>
<body>
    <h2>Add Department</h2>
    <form method="post">
        <input type="text" name="department_name" placeholder="Department Name" required><br>
        <button type="submit" name="add_department">Add Department</button>
        <button type="reset">Reset</button><br>
    </form>

    <h2>Add Employee</h2>
    <form method="post">
        <h3>Enter Employee Details:</h3>
        <p>Enter Your Name:</p><input type="text" name="name" placeholder="Name" required><br>
        <p>Enter Your age:</p><input type="number" name="age" placeholder="Age" required><br>
        <p>Enter your Email:</p><input type="email" name="email" placeholder="Email" required><br>
        <p>Select Your Department</p><select name="department_id" required>
            <option value="">Department</option>
            <?php while ($row = $departments->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>"><?= $row['department_name'] ?> (ID: <?= $row['id'] ?>)</option>
            <?php } ?>
        </select><br>
        <button type="submit" name="add_employee">Add Employee</button>
        <button type="reset">Reset</button><br>
    </form>
</body>
</html>