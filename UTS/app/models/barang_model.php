<?php

class Barang_model {
    private $tabel = 'barang';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllBarang() {
        $this->db->query('SELECT * FROM ' . $this->tabel . ' ORDER BY id DESC');
        return $this->db->resultSet();
    }

    public function getBarangById($id) {
        $this->db->query('SELECT * FROM ' . $this->tabel . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataBarang($data, $namaFileFoto) {
        
        $opsi = (isset($data['opsi']) && is_array($data['opsi'])) ? implode(', ', $data['opsi']) : '[tidak ada]';

        $query = "INSERT INTO " . $this->tabel . " 
                  (nama_barang, kategori, sub_kategori, stok, deskripsi, kondisi, opsi, foto, tanda_tangan)
                  VALUES
                  (:nama_barang, :kategori, :sub_kategori, :stok, :deskripsi, :kondisi, :opsi, :foto, :tanda_tangan)";

        $this->db->query($query);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->bind('sub_kategori', $data['sub_kategori']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('kondisi', $data['kondisi']);
        $this->db->bind('opsi', $opsi);
        $this->db->bind('foto', $namaFileFoto); 
        $this->db->bind('tanda_tangan', $data['tanda_tangan']); 

        $this->db->execute();

        return $this->db->rowCount(); 
    }

    public function hapusDataBarang($id) {
        $query = "DELETE FROM " . $this->tabel . " WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
    
    public function updateDataBarang($data, $namaFileFoto) {
        $opsi = (isset($data['opsi']) && is_array($data['opsi'])) ? implode(', ', $data['opsi']) : '[tidak ada]';

        $query = "UPDATE " . $this->tabel . " SET 
                    nama_barang = :nama_barang,
                    kategori = :kategori,
                    sub_kategori = :sub_kategori,
                    stok = :stok,
                    deskripsi = :deskripsi,
                    kondisi = :kondisi,
                    opsi = :opsi,
                    foto = :foto,
                    tanda_tangan = :tanda_tangan
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->bind('sub_kategori', $data['sub_kategori']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('kondisi', $data['kondisi']);
        $this->db->bind('opsi', $opsi);
        $this->db->bind('foto', $namaFileFoto);
        $this->db->bind('tanda_tangan', $data['tanda_tangan']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
