<?php

class KriteriaModel {
    private $db;

    public function __construct() {
        $this->db = require BASE_PATH . '/koneksi.php';
    }

    public function getAll() {
        $query = "SELECT * FROM kriteria ORDER BY kode ASC";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kriteria WHERE kriteria_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data) {
        $stmt = $this->db->prepare("INSERT INTO kriteria (kode, nama_kriteria, bobot) VALUES (?, ?, ?)");
        $stmt->bind_param('ssd', $data['kode'], $data['nama_kriteria'], $data['bobot']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE kriteria SET kode = ?, nama_kriteria = ?, bobot = ? WHERE kriteria_id = ?");
        $stmt->bind_param('ssdi', $data['kode'], $data['nama_kriteria'], $data['bobot'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kriteria WHERE kriteria_id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
