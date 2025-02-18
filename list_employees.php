<?php
include "db_connect.php";

$message = "";

if (isset($_POST["update_employee"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $department_id = $_POST["department_id"];
    if ($conn->query("UPDATE Employees SET name='$name', age=$age, email='$email', department_id=$department_id WHERE id=$id")) {
        $message = "Employee updated successfully.";
    } else {
        $message = "Error updating employee: " . $conn->error;
    }
}

if (isset($_POST["delete_employee"])) {
    $id = $_POST["id"];
    if ($conn->query("DELETE FROM Employees WHERE id=$id")) {
        $message = "Employee deleted successfully.";
    } else {
        $message = "Error deleting employee: " . $conn->error;
    }
}

$employees = $conn->query("SELECT Employees.id, Employees.name, Employees.age, Employees.email, 
                                 Departments.department_name, Employees.department_id
                          FROM Employees
                          LEFT JOIN Departments ON Employees.department_id = Departments.id");
$departments = $conn->query("SELECT * FROM Departments");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
</head>
<body>
    <h2>Employees</h2>
    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $employees->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['age'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['department_name'] ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="name" value="<?= $row['name'] ?>">
                        <input type="hidden" name="age" value="<?= $row['age'] ?>">
                        <input type="hidden" name="email" value="<?= $row['email'] ?>">
                        <input type="hidden" name="department_id" value="<?= $row['department_id'] ?>">
                        <button type="submit" name="update_employee">Update</button>
                    </form>
                    <!-- Delete Form -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete_employee">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>