<?php
class HomeController {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function index() {
        if (isset($_SESSION['user_id'])) {
            // Get user's recent tasks
            $this->db->query("SELECT * FROM tasks 
                WHERE user_id = :user_id 
                ORDER BY created_at DESC 
                LIMIT 5");
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $recentTasks = $this->db->resultSet();
            
            // Get tasks count
            $this->db->query("SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed
                FROM tasks 
                WHERE user_id = :user_id");
            $this->db->bind(':user_id', $_SESSION['user_id']);
            $taskStats = $this->db->single();
        }

        require '../src/Views/home/index.php';
    }
}