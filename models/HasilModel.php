<?php

class HasilModel {
    private $db;

    public function __construct() {
        $this->db = require BASE_PATH . '/koneksi.php';
    }

    public function getKriteria() {
        $result = $this->db->query("SELECT * FROM kriteria ORDER BY kode ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPenilaian() {
        $query = "
            SELECT p.*, s.nama_siswa, s.jenis_kelamin, k.nama_kelas
            FROM penilaian_kedisiplinan p
            JOIN siswa s ON p.siswa_id = s.siswa_id
            JOIN kelas k ON s.kelas_id = k.kelas_id
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function simpanHasil($siswa_id, $total_nilai, $ranking = null) {
        $stmt = $this->db->prepare("
            REPLACE INTO hasil_evaluasi (siswa_id, total_nilai, ranking)
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param('idi', $siswa_id, $total_nilai, $ranking);
        return $stmt->execute();
    }

    public function getHasilEvaluasi() {
        $query = "
            SELECT h.*, s.nama_siswa, k.nama_kelas
            FROM hasil_evaluasi h
            JOIN siswa s ON h.siswa_id = s.siswa_id
            JOIN kelas k ON s.kelas_id = k.kelas_id
            ORDER BY h.total_nilai DESC
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function resetHasil() {
        return $this->db->query("DELETE FROM hasil_evaluasi");
    }
}
