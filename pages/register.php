<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include '../config/Database.php';
    require '../includes/header.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];            //  TODO: use htmlspecialchars() to sanitize password
        $password = $_POST['password'];           // TODO: use hashing algo to encrypt using password_hash()
        $email = $_POST['email'];

        password_hash($password, sha1($password));
        // simple validation for now
        if (!empty($username) && !empty($password) && !empty($email)) {
            // instantiating da database right here
            $db = new Database();
            $result = $db->registerUser($username, $email, $password);

            if ($result) {
                header('Location: login.php');  // redirecting to da dashboard
                exit;
            } else {
                echo 'Invalid login credentials';
            }
        }
    }
    ?>

    <div class="container mt-5">
        <div class="header d-flex justify-content-center align-item-center m-3">
            <h1>Register</h1>
        </div>
        <div class="form d-flex  align-item-center justify-content-center">
            <form action="register.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                    <div class="form-text" id="emailHelp">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="submit d-flex justify-content-between align-item-center">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="login.php">Log in instead</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>