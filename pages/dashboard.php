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


    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $name = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);
        $gender = htmlspecialchars($_POST['gender']);
        $department = htmlspecialchars($_POST['department']);

        if(!empty($name) && !empty($address) && !empty($gender) && !empty($department)) {
            $db = new Database();
            $result = $db->registerEmployee($name, $address, $gender, $department);

            if($result) {
                header("Location: ./view.php");
                exit;
            } else {
                echo "Invalid Credentials";
            }
        }

        
    }

    ?>
    <div class="container d-flex flex-column mt-5 p-4 bg-white rounded shadow-sm">
        <div class="header text-center mb-4">
            <h1 class="fw-bold">CRUD Operation</h1>
        </div>
        <div class="form">
            <form action="dashboard.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label><br>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label><br>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <div>
                        <input type="radio" id="male" name="gender" value="male" class="form-check-input">
                        <label for="male" class="form-check-label me-3">Male</label>
                        <input type="radio" id="female" name="gender" value="female" class="form-check-input">
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label><br>
                    <input type="text" name="department" id="department" class="form-control" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>