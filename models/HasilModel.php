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

    public function getPenilaianBySiswaId($siswa_id) {
        $stmt = $this->db->prepare("
            SELECT p.* 
            FROM penilaian_kedisiplinan p
            WHERE p.siswa_id = ?
        ");
        $stmt->bind_param('i', $siswa_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getHasilBySiswaId($siswa_id) {
        $stmt = $this->db->prepare("
            SELECT h.* 
            FROM hasil_evaluasi h
            WHERE h.siswa_id = ?
        ");
        $stmt->bind_param('i', $siswa_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
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
            SELECT h.*, s.nama_siswa, s.jenis_kelamin, k.nama_kelas
            FROM hasil_evaluasi h
            JOIN siswa s ON h.siswa_id = s.siswa_id
            JOIN kelas k ON s.kelas_id = k.kelas_id
            ORDER BY h.ranking
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function resetHasil() {
        return $this->db->query("DELETE FROM hasil_evaluasi");
    }

    public function getRataRataNilai() {
        $query = "SELECT AVG(total_nilai) as rata_rata FROM hasil_evaluasi";
        $result = $this->db->query($query);
        $data = $result->fetch_assoc();
        return $data ? $data['rata_rata'] : 0;
    }

    public function getNilaiTertinggi() {
        $query = "
            SELECT h.total_nilai, s.nama_siswa 
            FROM hasil_evaluasi h
            JOIN siswa s ON h.siswa_id = s.siswa_id
            ORDER BY h.total_nilai DESC
            LIMIT 1
        ";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function getNilaiTerendah() {
        $query = "
            SELECT h.total_nilai, s.nama_siswa 
            FROM hasil_evaluasi h
            JOIN siswa s ON h.siswa_id = s.siswa_id
            ORDER BY h.total_nilai ASC
            LIMIT 1
        ";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function getTopSiswa($limit = 5) {
        $query = "
            SELECT h.*, s.nama_siswa, s.jenis_kelamin, k.nama_kelas
            FROM hasil_evaluasi h
            JOIN siswa s ON h.siswa_id = s.siswa_id
            JOIN kelas k ON s.kelas_id = k.kelas_id
            ORDER BY h.total_nilai DESC
            LIMIT ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDistribusiNilai() {
        $query = "
            SELECT 
                COUNT(CASE WHEN total_nilai >= 3.5 THEN 1 END) as sangat_baik,
                COUNT(CASE WHEN total_nilai >= 3.0 AND total_nilai < 3.5 THEN 1 END) as baik,
                COUNT(CASE WHEN total_nilai >= 2.5 AND total_nilai < 3.0 THEN 1 END) as cukup,
                COUNT(CASE WHEN total_nilai < 2.5 THEN 1 END) as kurang
            FROM hasil_evaluasi
        ";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function getChartData() {
        $query = "
            SELECT s.nama_siswa, h.total_nilai 
            FROM hasil_evaluasi h
            JOIN siswa s ON h.siswa_id = s.siswa_id
            ORDER BY h.total_nilai DESC
        ";
        $result = $this->db->query($query);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        
        $labels = [];
        $values = [];
        
        foreach ($data as $row) {
            $labels[] = $row['nama_siswa'];
            $values[] = $row['total_nilai'];
        }
        
        return [
            'labels' => $labels,
            'values' => $values
        ];
    }

    public function getKriteriaValues() {
        $query = "
            SELECT k.kode, k.nama_kriteria, k.bobot,
                AVG(CASE WHEN k.kode = 'C1' THEN p.c1
                    WHEN k.kode = 'C2' THEN p.c2
                    WHEN k.kode = 'C3' THEN p.c3
                    WHEN k.kode = 'C4' THEN p.c4
                    WHEN k.kode = 'C5' THEN p.c5
                    WHEN k.kode = 'C6' THEN p.c6
                    WHEN k.kode = 'C7' THEN p.c7
                    END) as rata_nilai
            FROM kriteria k
            CROSS JOIN penilaian_kedisiplinan p
            GROUP BY k.kode, k.nama_kriteria, k.bobot
            ORDER BY k.kode
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function hitungWSM() {
        $penilaian = $this->getPenilaian();
        $kriteria = $this->getKriteria();
        $bobot = [];
        foreach ($kriteria as $k) {
            $bobot[$k['kode']] = $k['bobot'];
        }
        
        $this->resetHasil();
        
        foreach ($penilaian as $p) {
            $total = 0;
            $total += $p['c1'] * $bobot['C1']; 
            $total += $p['c2'] * $bobot['C2']; 
            $total += $p['c3'] * $bobot['C3']; 
            $total += $p['c4'] * $bobot['C4']; 
            $total += $p['c5'] * $bobot['C5']; 
            $total += $p['c6'] * $bobot['C6']; 
            $total += $p['c7'] * $bobot['C7']; 
            
            $this->simpanHasil($p['siswa_id'], $total);
        }
        
        $query = "
            SET @rank = 0;
            UPDATE hasil_evaluasi
            SET ranking = (@rank := @rank + 1)
            ORDER BY total_nilai DESC;
        ";
        $this->db->multi_query($query);
        
        while ($this->db->more_results() && $this->db->next_result()) {}
        
        return true;
    }
    
    public function getDashboardData() {
        return [
            'hasil' => $this->getHasilEvaluasi(),
            'top_siswa' => $this->getTopSiswa(5),
            'nilai_tertinggi' => $this->getNilaiTertinggi(),
            'nilai_terendah' => $this->getNilaiTerendah(),
            'rata_rata' => $this->getRataRataNilai(),
            'distribusi' => $this->getDistribusiNilai(),
            'chart_data' => $this->getChartData(),
            'kriteria_values' => $this->getKriteriaValues()
        ];
    }
}