<?php
require_once MODEL_PATH . 'HasilModel.php';
require_once MODEL_PATH . 'SiswaModel.php';

class DashboardController {
    private $hasilModel;
/*************  ✨ Windsurf Command ⭐  *************/
/*******  ccea670f-e51d-44cd-a625-fd7094ac0878  *******/    private $siswaModel;

    public function __construct() {
        $this->hasilModel = new HasilModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $role = $_SESSION['role'];
        $nama = $_SESSION['nama_lengkap'];

        $data = [
            'role' => $role,
            'nama' => $nama,
            'hasilWSM' => $this->hasilModel->getHasilEvaluasi(),
            'totalSiswa' => $this->siswaModel->getTotalSiswa(),
            'rataRataNilai' => $this->hasilModel->getRataRataNilai(),
            'nilaiTertinggi' => $this->hasilModel->getNilaiTertinggi(),
            'nilaiTerendah' => $this->hasilModel->getNilaiTerendah(),
            'topSiswa' => $this->hasilModel->getTopSiswa(5),
            'distribusiNilai' => $this->hasilModel->getDistribusiNilai(),
            'chartData' => $this->hasilModel->getChartData(),
            'distribusiJK' => $this->siswaModel->getDistribusiJenisKelamin(),
            'siswaPerKelas' => $this->siswaModel->getSiswaByKelas(),
            'chartDataJK' => $this->siswaModel->getChartDataJenisKelamin(),
            'kriteriaValues' => $this->hasilModel->getKriteriaValues()
        ];

        require_once VIEW_PATH . 'home/index.php';
    }

    public function hitungWSM() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $success = $this->hasilModel->hitungWSM();

        if ($success) {
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Perhitungan WSM berhasil dilakukan.'
            ];
        } else {
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat melakukan perhitungan WSM.'
            ];
        }

        header('Location: index.php?controller=Dashboard');
        exit;
    }

    public function cetak() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $data = [
            'hasil' => $this->hasilModel->getHasilEvaluasi(),
            'kriteria' => $this->hasilModel->getKriteria(),
            'tanggal' => date('Y-m-d'),
            'user' => $_SESSION['nama_lengkap']
        ];

        require_once VIEW_PATH . 'hasil/cetak.php';
    }

    public function detail($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $siswa = $this->siswaModel->getById($id);
        if (!$siswa) {
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Siswa tidak ditemukan.'
            ];
            header('Location: index.php?controller=Dashboard');
            exit;
        }

        $penilaian = $this->hasilModel->getPenilaianBySiswaId($id);
        $hasil = $this->hasilModel->getHasilBySiswaId($id);
        $kriteria = $this->hasilModel->getKriteria();

        $data = [
            'siswa' => $siswa,
            'penilaian' => $penilaian,
            'hasil' => $hasil,
            'kriteria' => $kriteria
        ];

        require_once VIEW_PATH . 'siswa/detail.php';
    }
}