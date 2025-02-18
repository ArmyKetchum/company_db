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
                <form method="post">
                    <td><?= $row['id'] ?></td>
                    <td><input type="text" name="name" value="<?= $row['name'] ?>"></td>
                    <td><input type="number" name="age" value="<?= $row['age'] ?>"></td>
                    <td><input type="email" name="email" value="<?= $row['email'] ?>"></td>
                    <td>
                        <select name="department_id">
                            <?php
                            $departments->data_seek(0); // Reset the pointer to the beginning
                            while ($dept = $departments->fetch_assoc()) { ?>
                                <option value="<?= $dept['id'] ?>" <?= $dept['id'] == $row['department_id'] ? 'selected' : '' ?>>
                                    <?= $dept['department_name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="update_employee">Update</button>
                        <button type="submit" name="delete_employee">Delete</button>
                    </td>
                </form>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>