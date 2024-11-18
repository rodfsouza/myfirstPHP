<?php
class AuthController {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(':email', $email);
            $user = $this->db->single();

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_email'] = $user->email;
                header('Location: /tasks');
                exit;
            } else {
                $error = "Invalid credentials";
            }
        }
        require '../src/Views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $this->db->query("INSERT INTO users (email, password) VALUES (:email, :password)");
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $password);

            if ($this->db->execute()) {
                header('Location: /login');
                exit;
            }
        }
        require '../src/Views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
?>