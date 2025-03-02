<?php
define('SMTP_HOST', 'smtp.gmail.com'); // Gmail SMTP server
define('SMTP_PORT', 587); // Gmail SMTP port
define('SMTP_USER', 'nourraach89@gmail.com'); // Your Gmail address
define('SMTP_PASS', 'hwgu rhko ehqa qlic');
define('SMTP_FROM', 'nourraach89@gmail.com'); // Sender email address
define('SMTP_FROM_NAME', 'nour');

class Database {
    private $host = "localhost";
    private $db_name = "monstagecni";
    private $username = "root";
    private $password = "";
    public $conn; // PDO connection
    public $mysqli; // MySQLi connection

    // Constructor to initialize MySQLi connection
    public function __construct() {
        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->mysqli->connect_error) {
            die("MySQLi connection failed: " . $this->mysqli->connect_error);
        }
    }

    // Method to get PDO connection
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "PDO connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    // Method to get MySQLi connection
    public function getMysqliConnection() {
        return $this->mysqli;
    }
}

// Usage example:
$database = new Database();
$pdoConnection = $database->getConnection();
$mysqliConnection = $database->getMysqliConnection();
?>