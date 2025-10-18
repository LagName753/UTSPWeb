<?php

class Auth extends Controller {
    
    // Ke Barang
    public function index() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/barang');
            exit;
        }
        
        $data['judul'] = 'Login';
        $this->view('auth/login', $data);
    }

    // LogIn
    public function prosesLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = $this->model('user_model');
        $user = $userModel->getUserByUsername($username);

        // Cek PassWord
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                
                header('Location: ' . BASE_URL . '/barang');
                exit;
            } else {
                Flasher::setFlash('Password salah.', 'danger');
                header('Location: ' . BASE_URL . '/auth');
                exit;
            }
        } else {
            Flasher::setFlash('Username tidak ditemukan.', 'danger');
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }

    // LogOut
    public function logout() {
        session_destroy(); // Hancurkan "tiket masuk"
        header('Location: ' . BASE_URL . '/auth');
        exit;
    }
}
