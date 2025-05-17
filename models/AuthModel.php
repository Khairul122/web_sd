<?php

class AuthModel {
    private $db;

    public function __construct() {
        $this->db = require BASE_PATH . '/koneksi.php'; 
    }

    public function getByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, nama_lengkap, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $data['username'], $data['password'], $data['nama_lengkap'], $data['role']);
        return $stmt->execute();
    }
}
