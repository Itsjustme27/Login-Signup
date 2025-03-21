<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start();
    require '../includes/header.php';
    include '../config/Database.php';

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit;
    }

    echo "
    <div>
        <h1> Welcome, " . $_SESSION['username'] . "!</h1>
    </div>";


    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $name = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);
        $gender = htmlspecialchars($_POST['gender']);
        $department = htmlspecialchars($_POST['department']);

        if (!empty($name) && !empty($address) && !empty($gender) && !empty($department)) {
            $db = new Database();
            $result = $db->registerEmployee($name, $address, $gender, $department);

            if ($result) {
                echo "<script>alert('Record Added Successfully!');</script>";
                header("Location : dashboard.php");
            } else {
                echo "Invalid Credentials";
            }
        }
    }

    ?>
    <div class="container d-flex flex-column mt-5 bg-white rounded shadow-sm">
        <div class="header text-center mb-4 d-flex flex-column">
            <h1 class="fw-bold">CRUD Operation</h1>
            <h3 id="updateMode"></h3>
        </div>
        <div class="form border border-dark-subtle rounded-5 p-3 ">
            <form action="dashboard.php" method="post">
                <div class="d-flex flex-column m-5">
                    <label for="name" class="form-label"><b>Name</b></label><br>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="d-flex flex-column m-5">
                    <label for="address" class="form-label"><b>Address</b></label><br>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="d-flex flex-column m-5">
                    <label for="gender" class="form-label"><b>Gender</b></label><br>
                    <div>
                        <input type="radio" id="male" name="gender" value="male" class="form-check-input m-2">
                        <label for="male" class="form-check-label me-3">Male</label>
                        <input type="radio" id="female" name="gender" value="female" class="form-check-input m-2">
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="d-flex flex-column m-5">
                    <label for="department" class="form-label"><b>Department</b></label><br>
                    <select name="department" id="department" class="w-100">
                        <option value="CSIT">CSIT</option>
                        <option value="BBA">BBA</option>
                        <option value="BHM">BHM</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100 m-3">Submit</button>
                </div>
            </form>
        </div>
        <div class="table-container d-flex m-5 p-3">
            <table class="table table-dark p-3">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "../config/Database.php";

                    $sql = "SELECT * FROM employee";
                    $db = new Database();
                    $result = mysqli_query($db->getConnection(), $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $Id = $row['S.N.'];
                        $Name = $row['Name'];
                        $Address = $row['Address'];
                        $Gender = $row['Gender'];
                        $Department = $row['Department'];
                        echo "<tr class='trow'>
                        <td>{$Id}</td>
                        <td>{$Name}</td>
                        <td>{$Address}</td>
                        <td>{$Gender}</td>
                        <td>{$Department}</td>
                        <td><a href='update.php?id={$Id}' class='btn btn-success' id='buttonText'>Edit</a></td>
                        <td><a href='delete.php?id={$Id}' class='btn btn-danger'>Delete</a></td>
                        </tr>";
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <!-- <script>
            function updateTable() {
                let updateText = document.querySelector('#updateMode');

                let buttonText = document.querySelector('#buttonText');

                // Simple Edit Toggle 
                if(buttonText.innerHTML == "Edit") {
                    updateText.innerHTML = "WARNING! Entered Update Mode!";
                    buttonText.innerHTML = "Cancel";
                } else if(buttonText.innerHTML == "Cancel") {
                    updateText.innerHTML = null;
                    buttonText.innerHTML = "Edit";
                }
            }
        </script> -->
</body>

</html>