<?php

class DashboardController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }

        $role = $_SESSION['role'];
        $nama = $_SESSION['nama_lengkap'];

        require_once VIEW_PATH . 'home/index.php';
    }
}
