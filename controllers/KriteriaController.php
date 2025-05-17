<?php
require_once MODEL_PATH . 'KriteriaModel.php';

class KriteriaController {
    private $model;

    public function __construct() {
        $this->model = new KriteriaModel();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $data['kriteria'] = $this->model->getAll();
        require_once VIEW_PATH . 'kriteria/index.php';
    }

    public function tambah() {
        require_once VIEW_PATH . 'kriteria/form.php';
    }

    public function simpan() {
        $data = [
            'kode' => $_POST['kode'],
            'nama_kriteria' => $_POST['nama_kriteria'],
            'bobot' => $_POST['bobot']
        ];
        $this->model->insert($data);
        header('Location: index.php?controller=Kriteria&action=index');
    }

    public function edit() {
        $id = $_GET['id'];
        $data['kriteria'] = $this->model->getById($id);
        require_once VIEW_PATH . 'kriteria/form.php';
    }

    public function update() {
        $id = $_POST['kriteria_id'];
        $data = [
            'kode' => $_POST['kode'],
            'nama_kriteria' => $_POST['nama_kriteria'],
            'bobot' => $_POST['bobot']
        ];
        $this->model->update($id, $data);
        header('Location: index.php?controller=Kriteria&action=index');
    }

    public function hapus() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: index.php?controller=Kriteria&action=index');
    }
}
