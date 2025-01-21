<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>

<body>
    <?php
    include "../config/Database.php";

    $db = new Database();
    $result = $db->viewTableEmployee();

    ?>
    <div class="container">
        <h1>Employees</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['s.n.'] ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a
                                    class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                        </tr> <?php }
                } ?>
                </tr>
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>