<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../config/Database.php";

$id = $_GET["id"];

$db = new Database();
$sql = "DELETE FROM employee WHERE `S.N.` = '$id'";

if(mysqli_query($db->getConnection(), $sql)) {
    header("Location: ./dashboard.php");
} else {
    echo "Something went wrong! Please try again!";
}
?>