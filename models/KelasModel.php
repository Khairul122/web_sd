<?php

class KelasModel {
    private $db;

    public function __construct() {
        $this->db = require BASE_PATH . '/koneksi.php';
    }

    public function getAll() {
        $query = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kelas WHERE kelas_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data) {
        $stmt = $this->db->prepare("INSERT INTO kelas (nama_kelas) VALUES (?)");
        $stmt->bind_param('s', $data['nama_kelas']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE kelas SET nama_kelas = ? WHERE kelas_id = ?");
        $stmt->bind_param('si', $data['nama_kelas'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kelas WHERE kelas_id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
