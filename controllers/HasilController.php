<?php
require_once MODEL_PATH . 'HasilModel.php';

class HasilController {
    private $model;

    public function __construct() {
        $this->model = new HasilModel();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $data['hasil'] = $this->model->getHasilEvaluasi();
        require_once VIEW_PATH . 'hasil/index.php';
    }

    public function hitung() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $this->model->resetHasil();

        $kriteria = $this->model->getKriteria();
        $penilaian = $this->model->getPenilaian();

        $bobot = [];
        foreach ($kriteria as $k) {
            $bobot[strtolower($k['kode'])] = $k['bobot'];
        }

        $hasil = [];
        foreach ($penilaian as $p) {
            $total = 0;
            foreach ($bobot as $kode => $bobot_kriteria) {
                if (isset($p[$kode])) {
                    $total += $p[$kode] * $bobot_kriteria;
                }
            }
            $hasil[] = ['siswa_id' => $p['siswa_id'], 'total' => $total];
        }

        usort($hasil, fn($a, $b) => $b['total'] <=> $a['total']);
        $ranking = 1;
        foreach ($hasil as $h) {
            $this->model->simpanHasil($h['siswa_id'], $h['total'], $ranking++);
        }

        header('Location: index.php?controller=Hasil&action=index');
    }
}
