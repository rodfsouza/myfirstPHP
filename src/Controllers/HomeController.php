<?php
class HomeController {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function index() {
        // Get user stats if authenticated
        $stats = [];
        if (isset($_SESSION['user_id'])) {
            $this->db->query("SELECT 
                (SELECT COUNT(*) FROM tasks WHERE user_id = :user_id) as total_tasks,
                (SELECT COUNT(*) FROM tasks WHERE user_id = :user_id AND status = 'completed') as completed_tasks,
                (SELECT COUNT(*) FROM tasks WHERE user_id = :user_id AND status = 'pending') as pending_tasks"
            );
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $stats = $this->db->single();
        }

        require '../src/Views/home/index.php';
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        // Get recent activity
        $this->db->query("SELECT t.*, 
            (SELECT COUNT(*) FROM tasks WHERE user_id = :user_id) as total_tasks,
            (SELECT COUNT(*) FROM tasks WHERE user_id = :user_id AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)) as new_tasks_week
            FROM tasks t 
            WHERE t.user_id = :user_id 
            ORDER BY t.created_at DESC 
            LIMIT 5"
        );
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $recentActivity = $this->db->resultSet();

        require '../src/Views/home/dashboard.php';
    }

    public function about() {
        require '../src/Views/home/about.php';
    }

    public function contact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

            // Process contact form (e.g., send email, store in database)
            // Add your contact form processing logic here

            $_SESSION['flash'] = 'Message sent successfully!';
            header('Location: /contact');
            exit;
        }

        require '../src/Views/home/contact.php';
    }
}