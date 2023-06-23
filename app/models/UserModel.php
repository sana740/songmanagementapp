<?php

require_once 'config/database.php';

class UserModel {
    private $db;
    
    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->db->connect_errno) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getUserByUsername($username) {
        $username = $this->db->real_escape_string($username);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->db->query($query);

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function createUser($username, $password) {
        $username = $this->db->real_escape_string($username);
        $password = $this->db->real_escape_string($password);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        $result = $this->db->query($query);

        return $result;
    }
}

?>