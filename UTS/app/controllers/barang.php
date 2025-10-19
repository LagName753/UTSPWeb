<?php

class Barang extends Controller {
    
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }

    // List Barang
    public function index() {
        $data['judul'] = 'Dashboard Inventaris';
        $data['barang'] = $this->model('barang_model')->getAllBarang();
        
        $this->view('templates/header', $data);
        $this->view('barang/index', $data); 
        $this->view('templates/footer');
    }

    // Ke Form Tambah
    public function tambah() {
        $data['judul'] = 'Tambah Barang Baru';
        
        $this->view('templates/header', $data);
        $this->view('barang/tambah', $data); 
        $this->view('templates/footer');
    }

    // AJAX
    public function getSubKategori($kategori = '') {
        header('Content-Type: application/json');
        $data = [];

        if ($kategori == 'makanan') {
            $data = [
                ['value' => 'snack', 'text' => 'Snack (Ciki, dll)'],
                ['value' => 'mie', 'text' => 'Mie Instan'],
                ['value' => 'minuman', 'text' => 'Minuman Kemasan']
            ];
        } elseif ($kategori == 'sembako') {
            $data = [
                ['value' => 'beras', 'text' => 'Beras'],
                ['value' => 'minyak', 'text' => 'Minyak Goreng'],
                ['value' => 'gula', 'text' => 'Gula Pasir']
            ];
        } elseif ($kategori == 'lainnya') {
            $data = [
                ['value' => 'rokok', 'text' => 'Rokok'],
                ['value' => 'obat', 'text' => 'Obat-obatan'],
                ['value' => 'pulsa', 'text' => 'Pulsa & Token']
            ];
        }
        echo json_encode($data);
    }

    // Proses Tambah
    public function prosesTambah() {
        $namaFileFoto = $this->uploadFoto();
        if ($namaFileFoto === false) {
            Flasher::setFlash('Upload foto gagal. Pastikan file adalah gambar (jpg/jpeg/png) dan ukuran maks 2MB.', 'danger');
            header('Location: ' . BASE_URL . '/barang/tambah');
            exit;
        }

        if ($this->model('barang_model')->tambahDataBarang($_POST, $namaFileFoto) > 0) {
            Flasher::setFlash('Data barang baru berhasil ditambahkan.', 'success');
            header('Location: ' . BASE_URL . '/barang');
            exit;
        } else {
            Flasher::setFlash('Gagal menambahkan data barang.', 'danger');
            header('Location: ' . BASE_URL . '/barang/tambah');
            exit;
        }
    }

    // Upload Foto
    private function uploadFoto() {
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] == UPLOAD_ERR_NO_FILE) {
            return 'default.jpg'; 
        }

        $namaFile = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmpName = $_FILES['foto']['tmp_name'];

        $ekstensiValid = ['jpg', 'jpeg', 'png'];
        $ekstensiFile = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));
        if (!in_array($ekstensiFile, $ekstensiValid)) {
            return false; 
        }

        if ($ukuranFile > 2000000) {
            return false; 
        }

        $namaFileBaru = 'barang-' . uniqid() . '.' . $ekstensiFile;

        if (move_uploaded_file($tmpName, 'uploads/' . $namaFileBaru)) {
            return $namaFileBaru; 
        } else {
            return false; 
        }
    }

    // Hapus Barang
    public function hapus($id) {
        $dataBarang = $this->model('barang_model')->getBarangById($id);

        if ($dataBarang && $dataBarang['foto'] && $dataBarang['foto'] != 'default.jpg') {
            $pathFoto = 'uploads/' . $dataBarang['foto'];
            if (file_exists($pathFoto)) {
                unlink($pathFoto); 
            }
        }

        if ($this->model('barang_model')->hapusDataBarang($id) > 0) {
            Flasher::setFlash('Data barang berhasil dihapus.', 'success');
        } else {
            Flasher::setFlash('Gagal menghapus data barang.', 'danger');
        }
        
        header('Location: ' . BASE_URL . '/barang');
        exit;
    }
    
    // Form Edit
    public function edit($id) {
        $data['judul'] = 'Edit Data Barang';
        $data['barang'] = $this->model('barang_model')->getBarangById($id);
        
        $this->view('templates/header', $data);
        $this->view('barang/edit', $data); // Panggil view form edit
        $this->view('templates/footer');
    }
    
    // Foto Form Edit
    public function prosesEdit() {
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
            $namaFileFotoBaru = $this->uploadFoto();
            if ($namaFileFotoBaru === false) {
                Flasher::setFlash('Upload foto baru gagal. Pastikan file adalah gambar (jpg/jpeg/png) dan ukuran maks 2MB.', 'danger');
                header('Location: ' . BASE_URL . '/barang/edit/' . $_POST['id']);
                exit;
            }
            
            $fotoLama = $_POST['foto_lama'];
            if ($fotoLama && $fotoLama != 'default.jpg') {
                $pathFoto = 'uploads/' . $fotoLama;
                if (file_exists($pathFoto)) {
                    unlink($pathFoto);
                }
            }
        } else {
            $namaFileFotoBaru = $_POST['foto_lama'];
        }

        // Update Data
        if ($this->model('barang_model')->updateDataBarang($_POST, $namaFileFotoBaru) >= 0) {
            Flasher::setFlash('Data barang berhasil diperbarui.', 'success');
            header('Location: ' . BASE_URL . '/barang');
            exit;
        } else {
            Flasher::setFlash('Gagal memperbarui data barang.', 'danger');
            header('Location: ' . BASE_URL . '/barang/edit/' . $_POST['id']);
            exit;
        }
    }
}
