<?php
//POP code
// $host = "localhost:3306";
// $username = "your_username";
// $password = "your_password";
// $dbname = "user_auth";

// // Creating a connection
// $conn = new mysqli($host, $username, $password, $dbname);

// // Checking our connection
// if($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

// // Creating table SQL QUERY
// $sql = "CREATE TABLE users(
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(100) NOT NULL,
//     email VARCHAR(100) NOT NULL UNIQUE,
//     password VARCHAR(100) NOT NULL,
//     created_at DATETIME DEFAULT CURRENT_TIMESTAMP
// )";

// if($conn->query($sql) === TRUE) {
//     echo "Created table 'users' successfully\n";
// } else {
//     echo "Error creating table: ". $conn->error . "\n";
// }

// // Close connection
// $conn->close();

// Let's do this in OOP, seems more fun
class Database
{
    private $host = "localhost";
    private $username = "your_user";
    private $password = "your_password";
    private $dbname = "user_auth";
    private $conn;

    public function __construct()
    {
        // Creating da connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Checking da Connection!!
        if ($this->conn->connect_error) {
            die("Error Connecting : " . $this->conn->connect_error . "\n");
        } else {
            echo "Connection Successful";
        }
    }

    // Method for Creating da tablee
    public function createTable()
    {
        $sql = "CREATE TABLE users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(100) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";

        if($this->conn->query($sql)) {
            echo "Table 'users' created successfully\n";
        } else {
            echo "Table creation failed: " . $this->conn->error . "\n";
        }
    }


    public function closeConnection() {
        $this->conn->close();
    }

}

$db = new Database();
$db->createTable();
$db->closeConnection();
?>