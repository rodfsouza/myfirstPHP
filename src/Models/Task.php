<?php
namespace App\Models;

class Task {
    private $db;

    public function __construct() {
        $this->db = new \Database();
    }

    public function getAllByUser($userId) {
        $this->db->query("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function findById($id, $userId) {
        $this->db->query("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query("INSERT INTO tasks (title, description, status, user_id) 
                         VALUES (:title, :description, :status, :user_id)");
        
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status'] ?? 'pending');
        $this->db->bind(':user_id', $data['user_id']);
        
        return $this->db->execute();
    }

    public function update($data) {
        $this->db->query("UPDATE tasks 
                         SET title = :title, 
                             description = :description, 
                             status = :status 
                         WHERE id = :id AND user_id = :user_id");
        
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);
        
        return $this->db->execute();
    }

    public function delete($id, $userId) {
        $this->db->query("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
}