<?php
require_once MODEL_PATH . 'HasilModel.php';

class HasilController
{
    private $model;

    public function __construct()
    {
        $this->model = new HasilModel();
    }

    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $data['hasil'] = $this->model->getHasilEvaluasi();
        require_once VIEW_PATH . 'hasil/index.php';
    }

    public function hitung()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $this->model->resetHasil();

        $kriteria = $this->model->getKriteria();
        $penilaian = $this->model->getPenilaian();

        // Buat array bobot dengan key sesuai format database
        $bobot = [];
        foreach ($kriteria as $k) {
            $bobot[$k['kode']] = $k['bobot'];
        }

        $hasil = [];
        foreach ($penilaian as $p) {
            // Cetak data mentah untuk debugging
            // echo "<pre>"; print_r($p); echo "</pre>";

            $total = 0;
            // Eksplisit menghitung dengan nama kolom yang pasti
            $total += $p['c1'] * $bobot['C1'];
            $total += $p['c2'] * $bobot['C2'];
            $total += $p['c3'] * $bobot['C3'];
            $total += $p['c4'] * $bobot['C4'];
            $total += $p['c5'] * $bobot['C5'];
            $total += $p['c6'] * $bobot['C6'];
            $total += $p['c7'] * $bobot['C7'];

            $hasil[] = ['siswa_id' => $p['siswa_id'], 'total' => $total];

            echo "Siswa {$p['nama_siswa']}: {$p['c1']}*{$bobot['C1']} + {$p['c2']}*{$bobot['C2']} + ... = $total<br>";
        }

        usort($hasil, fn($a, $b) => $b['total'] <=> $a['total']);
        $ranking = 1;
        foreach ($hasil as $h) {
            $this->model->simpanHasil($h['siswa_id'], $h['total'], $ranking++);
        }

        header('Location: index.php?controller=Hasil&action=index');
    }
}
