<?php

require_once 'app/models/UserModel.php';

class UserController {
    
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['userId'] = $user['id'];
                header('Location: index.php?action=home');
                exit();
            } else {
                echo "Invalid username or password.";
            }
        }

        require_once 'app/views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByUsername($username);

            if ($user) {
                echo "Username already exists.";
            } else {
                $result = $this->userModel->createUser($username, $password);

                if ($result) {
                    echo "User registered successfully.";
                } else {
                    echo "Failed to register user.";
                }
            }
        }

        require_once 'app/views/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
}

?>