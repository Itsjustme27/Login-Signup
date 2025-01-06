<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- TODO: -->
    <!--PHP code for tomorrow -->
    <?php
        session_start();
        require '../includes/header.php';
        include '../config/Database.php';
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['name'];
            $password = $_POST['password'];


            // Fetching da data from database
            $db = new Database();
            $stmt = $db->getConnection()->prepare('SELECT id, username, password FROM users 
                                        WHERE username = ?');
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0) {
                // $user = $result->fetch_assoc();
                if($password === $user["password"]) {
                    $_SESSION["username"] = $username;
                    header("Location: dashboard.php");
                    exit;
                } else {
                    echo "Invalid password";
                }
            } else {
                echo "Email is not registered";
            }
        }
    ?>

    <div class="container mt-5">
        <div class="header d-flex justify-content-center align-item-center m-3">
            <h1>Login</h1>
        </div>
        <div class="form d-flex  align-item-center justify-content-center">
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp">
                    <div class="form-text" id="nameHelp">We'll never share your data with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="submit d-flex justify-content-between align-item-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="register.php">Sign Up instead</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>