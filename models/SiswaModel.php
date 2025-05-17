<?php

class SiswaModel {
    private $db;

    public function __construct() {
        $this->db = require BASE_PATH . '/koneksi.php';
    }

    public function getAll() {
        $query = "
            SELECT s.*, k.nama_kelas 
            FROM siswa s 
            JOIN kelas k ON s.kelas_id = k.kelas_id
            ORDER BY s.nama_siswa ASC
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT s.*, k.nama_kelas 
            FROM siswa s 
            JOIN kelas k ON s.kelas_id = k.kelas_id 
            WHERE s.siswa_id = ?
        ");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data) {
        $stmt = $this->db->prepare("INSERT INTO siswa (nama_siswa, jenis_kelamin, kelas_id) VALUES (?, ?, ?)");
        $stmt->bind_param('ssi', $data['nama_siswa'], $data['jenis_kelamin'], $data['kelas_id']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE siswa SET nama_siswa = ?, jenis_kelamin = ?, kelas_id = ? WHERE siswa_id = ?");
        $stmt->bind_param('ssii', $data['nama_siswa'], $data['jenis_kelamin'], $data['kelas_id'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM siswa WHERE siswa_id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getAllKelas() {
        $result = $this->db->query("SELECT * FROM kelas ORDER BY nama_kelas ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
