<?php
require_once MODEL_PATH . 'PenilaianModel.php';

class PenilaianController {
    private $model;

    public function __construct() {
        $this->model = new PenilaianModel();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $data['penilaian'] = $this->model->getAll();
        require_once VIEW_PATH . 'penilaian/index.php';
    }

    public function tambah() {
        $data['siswa'] = $this->model->getAllSiswa();
        require_once VIEW_PATH . 'penilaian/form.php';
    }

    public function simpan() {
        $data = [
            'siswa_id' => $_POST['siswa_id'],
            'c1' => $_POST['c1'],
            'c2' => $_POST['c2'],
            'c3' => $_POST['c3'],
            'c4' => $_POST['c4'],
            'c5' => $_POST['c5'],
            'c6' => $_POST['c6'],
            'c7' => $_POST['c7']
        ];
        $this->model->insert($data);
        header('Location: index.php?controller=Penilaian&action=index');
    }

    public function edit() {
        $id = $_GET['id'];
        $data['penilaian'] = $this->model->getById($id);
        $data['siswa'] = $this->model->getAllSiswa();
        require_once VIEW_PATH . 'penilaian/form.php';
    }

    public function update() {
        $id = $_POST['penilaian_id'];
        $data = [
            'siswa_id' => $_POST['siswa_id'],
            'c1' => $_POST['c1'],
            'c2' => $_POST['c2'],
            'c3' => $_POST['c3'],
            'c4' => $_POST['c4'],
            'c5' => $_POST['c5'],
            'c6' => $_POST['c6'],
            'c7' => $_POST['c7']
        ];
        $this->model->update($id, $data);
        header('Location: index.php?controller=Penilaian&action=index');
    }

    public function hapus() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: index.php?controller=Penilaian&action=index');
    }
}
