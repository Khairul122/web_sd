<?php
require_once MODEL_PATH . 'AuthModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new AuthModel();
    }

    public function login() {
        require_once VIEW_PATH . 'auth/login.php';
    }

    public function prosesLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model->getByUsername($username);

        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['role'] = $user['role'];

            header('Location: index.php?controller=Dashboard&action=index');
        } else {
            header('Location: index.php?controller=Auth&action=login&error=Login gagal');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=Auth&action=login');
    }

    public function register() {
        require_once VIEW_PATH . 'register.php';
    }

    public function prosesRegister() {
        $data = [
            'username' => $_POST['username'],
            'password' => $_POST['password'], // plain-text sesuai permintaan
            'nama_lengkap' => $_POST['nama_lengkap'],
            'role' => $_POST['role']
        ];

        $cek = $this->model->getByUsername($data['username']);
        if ($cek) {
            header('Location: index.php?controller=Auth&action=register&error=Username sudah digunakan');
            return;
        }

        $this->model->insert($data);
        header('Location: index.php?controller=Auth&action=login&success=Registrasi berhasil');
    }
}
