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

include "../config/config.php";
class Database
{
    private $host = DB_HOST;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;
    private $conn;

    public function __construct()
    {
        // Creating da connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Checking da Connection!!
        if ($this->conn->connect_error) {
            die("Error Connecting : " . $this->conn->connect_error . "\n");
        } else {
            echo "Connection Successful\n";
        }
    }

    public function getConnection() {
        return $this->conn;
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

    public function createTableCrud() {
        $sql = "CREATE TABLE employee(
                `S.N.` INT AUTO_INCREMENT PRIMARY KEY,
                Name VARCHAR(255) NOT NULL,
                Address VARCHAR(255) NOT NULL,
                Gender VARCHAR(255) NOT NULL,
                Department VARCHAR(255) NOT NULL
        )";

        if($this->conn->query($sql)) {
            echo "Table 'employee' created succcessfully";
        } else {
            echo "Failed to create table.";
        }
    }

    // Method for inserting da data from form 
    public function registerUser($username, $email, $password) {
        $sql = "INSERT INTO users (username, email,password)
                VALUES (?, ?, ?)                               
        ";  // The placeholders (?) represent the values that will be inserted. These are used to prevent SQL injection.

        $stmt = $this->conn->prepare($sql); // Prepares the SQL query for execution
        $stmt->bind_param("sss", $username, $email, $password); // Binds the actual values ($username, $email, $password) to the placeholders (?) in the query.
        // sss represents datatype "string"

        if($stmt->execute()) {
            return true;
        }else {
            echo "Errors: " . $stmt->error . "";
            return false;
        }
    }

    public function registerEmployee($name, $address, $gender, $department) {
        $sql = "INSERT INTO employee (Name, Address, Gender, Department)
                VALUES (?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "Prepare failed: " . $this->conn->error; // Debugging prepared statement issues
            return false;
        }
    
        $stmt->bind_param("ssss", $name, $address, $gender, $department);
    
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Execution failed: " . $stmt->error; // Debugging execution issues
            return false;
        }
    }
    
    public function viewTableEmployee() {
        $sql = "SELECT * FROM employee";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()) {
            return true;
        } else {
            echo "Failed to fetch data: " . $stmt->error . "";
        }
    }
    // Just a method for closing connection after finishing da business
    public function closeConnection() {
        $this->conn->close();
    }
}

// $db = new Database();
// $db->createTable();
// $db->closeConnection();
// $db = new Database();
// $db->createTableCrud();
// $db->closeConnection();
?>