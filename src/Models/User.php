<?php
namespace App\Models;

class User {
    private $db;

    public function __construct() {
        $this->db = new \Database();
    }

    public function findByEmail($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function create($email, $password) {
        $this->db->query("INSERT INTO users (email, password) VALUES (:email, :password)");
        $this->db->bind(':email', $email);
        $this->db->bind(':password', password_hash($password, PASSWORD_DEFAULT));
        return $this->db->execute();
    }

    public function updatePassword($userId, $newPassword) {
        $this->db->query("UPDATE users SET password = :password WHERE id = :id");
        $this->db->bind(':password', password_hash($newPassword, PASSWORD_DEFAULT));
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }
}