<?php
include "db_connect.php";

$employees = $conn->query("SELECT Employees.id, Employees.name, Employees.age, Employees.email, 
                                  Employees.department_id, Departments.department_name 
                           FROM Employees
                           LEFT JOIN Departments ON Employees.department_id = Departments.id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
</head>
<body>
    <h2>Employees</h2>
    <table border="1">
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Department ID</th>
            <th>Department Name</th>
        </tr>
        <?php while ($row = $employees->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['age'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['department_id'] ?></td>
                <td><?= $row['department_name'] ?? 'N/A' ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
