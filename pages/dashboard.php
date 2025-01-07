<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php
    session_start();
    require '../includes/header.php';

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit;
    }

    echo "
    <div>
        <h1> Welcome, " . $_SESSION['username'] . "!</h1>
    </div>";
    ?>
    <div>
        <a href="../sessions/logout.php">Logout</a>
    </div>
</body>
</html>