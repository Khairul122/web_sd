<?php
require_once MODEL_PATH . 'SiswaModel.php';

class SiswaController {
    private $model;

    public function __construct() {
        $this->model = new SiswaModel();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $data['siswa'] = $this->model->getAll();
        require_once VIEW_PATH . 'siswa/index.php';
    }

    public function tambah() {
        $data['kelas'] = $this->model->getAllKelas();
        require_once VIEW_PATH . 'siswa/form.php';
    }

    public function simpan() {
        $data = [
            'nama_siswa' => $_POST['nama_siswa'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'kelas_id' => $_POST['kelas_id']
        ];
        $this->model->insert($data);
        header('Location: index.php?controller=Siswa&action=index');
    }

    public function edit() {
        $id = $_GET['id'];
        $data['siswa'] = $this->model->getById($id);
        $data['kelas'] = $this->model->getAllKelas();
        require_once VIEW_PATH . 'siswa/form.php';
    }

    public function update() {
        $id = $_POST['siswa_id'];
        $data = [
            'nama_siswa' => $_POST['nama_siswa'],
            'jenis_kelamin' => $_POST['jenis_kelamin'],
            'kelas_id' => $_POST['kelas_id']
        ];
        $this->model->update($id, $data);
        header('Location: index.php?controller=Siswa&action=index');
    }

    public function hapus() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: index.php?controller=Siswa&action=index');
    }
}
