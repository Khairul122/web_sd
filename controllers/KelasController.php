<?php
require_once MODEL_PATH . 'KelasModel.php';

class KelasController {
    private $model;

    public function __construct() {
        $this->model = new KelasModel();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $data['kelas'] = $this->model->getAll();
        require_once VIEW_PATH . 'kelas/index.php';
    }

    public function tambah() {
        require_once VIEW_PATH . 'kelas/form.php';
    }

    public function simpan() {
        $data = [
            'nama_kelas' => $_POST['nama_kelas']
        ];
        $this->model->insert($data);
        header('Location: index.php?controller=Kelas&action=index');
    }

    public function edit() {
        $id = $_GET['id'];
        $data['kelas'] = $this->model->getById($id);
        require_once VIEW_PATH . 'kelas/form.php';
    }

    public function update() {
        $id = $_POST['kelas_id'];
        $data = [
            'nama_kelas' => $_POST['nama_kelas']
        ];
        $this->model->update($id, $data);
        header('Location: index.php?controller=Kelas&action=index');
    }

    public function hapus() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: index.php?controller=Kelas&action=index');
    }
}
