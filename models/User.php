<?php
class User {
    private $conn;
    private $table_name = "users"; // Updated table name
    public $id;
    public $username; // Updated from 'name' to 'username'
    public $email;
    public $password;
    public $phone_number; // Updated from 'num' to 'phone_number'

    public function __construct($db) {
        $this->conn = $db;
    }

    // Find a user by ID
    public function findUser($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Find all users
    public function findAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete a user by ID
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    // Update a user
    public function updateUser() {
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email, password = :password, phone_number = :phone_number WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':username', $this->username); // Updated from 'name' to 'username'
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':phone_number', $this->phone_number); // Updated from 'num' to 'phone_number'
        return $stmt->execute();
    }

    // Register a new user
    public function register($username, $email, $password, $phone_number) {
        $query = "INSERT INTO " . $this->table_name . " (username, email, password, phone_number) VALUES (:username, :email, :password, :phone_number)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username); // Updated from 'name' to 'username'
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindParam(':phone_number', $phone_number); // Updated from 'num' to 'phone_number'
        return $stmt->execute();
    }

    // Login a user
    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data if credentials are correct
        }
        return false;
    }

    // Forgot password
    public function forgotPassword($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>