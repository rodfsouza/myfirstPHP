<?php
class TaskController {
    private $db;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        $this->db = new Database;
    }

    public function index() {
        $this->db->query("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC");
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $tasks = $this->db->resultSet();
        require '../src/Views/tasks/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $this->db->query("INSERT INTO tasks (title, description, user_id) VALUES (:title, :description, :user_id)");
            $this->db->bind(':title', $title);
            $this->db->bind(':description', $description);
            $this->db->bind(':user_id', $_SESSION['user_id']);

            if ($this->db->execute()) {
                header('Location: /tasks');
                exit;
            }
        }
        require '../src/Views/tasks/create.php';
    }

    public function edit() {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $this->db->query("UPDATE tasks SET title = :title, description = :description WHERE id = :id AND user_id = :user_id");
            $this->db->bind(':title', $title);
            $this->db->bind(':description', $description);
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $_SESSION['user_id']);

            if ($this->db->execute()) {
                header('Location: /tasks');
                exit;
            }
        }

        $this->db->query("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $task = $this->db->single();

        require '../src/Views/tasks/edit.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $this->db->query("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $_SESSION['user_id']);

            if ($this->db->execute()) {
                header('Location: /tasks');
                exit;
            }
        }
    }
}
?>