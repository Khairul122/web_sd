<?php

class PenilaianModel {
    private $db;

    public function __construct() {
        $this->db = require BASE_PATH . '/koneksi.php';
    }

    public function getAll() {
        $query = "
            SELECT p.*, s.nama_siswa, s.jenis_kelamin, k.nama_kelas
            FROM penilaian_kedisiplinan p
            JOIN siswa s ON p.siswa_id = s.siswa_id
            JOIN kelas k ON s.kelas_id = k.kelas_id
            ORDER BY s.nama_siswa ASC
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM penilaian_kedisiplinan WHERE penilaian_id = ?
        ");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($data) {
        $stmt = $this->db->prepare("
            INSERT INTO penilaian_kedisiplinan 
            (siswa_id, c1, c2, c3, c4, c5, c6, c7) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param('iddddddd',
            $data['siswa_id'], $data['c1'], $data['c2'], $data['c3'],
            $data['c4'], $data['c5'], $data['c6'], $data['c7']
        );
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE penilaian_kedisiplinan 
            SET siswa_id=?, c1=?, c2=?, c3=?, c4=?, c5=?, c6=?, c7=? 
            WHERE penilaian_id = ?
        ");
        $stmt->bind_param('idddddddi',
            $data['siswa_id'], $data['c1'], $data['c2'], $data['c3'],
            $data['c4'], $data['c5'], $data['c6'], $data['c7'], $id
        );
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM penilaian_kedisiplinan WHERE penilaian_id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getAllSiswa() {
        $query = "
            SELECT s.siswa_id, s.nama_siswa, k.nama_kelas
            FROM siswa s
            JOIN kelas k ON s.kelas_id = k.kelas_id
            ORDER BY s.nama_siswa ASC
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
