<?php 
$brg = $data['barang']; 
$opsi_tersimpan = explode(', ', $brg['opsi']);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white py-4">
                    <h2 class="text-center heading-font">Edit Data Barang</h2>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <form action="<?php echo BASE_URL; ?>/barang/prosesEdit" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" value="<?php echo $brg['id']; ?>">
                        <input type="hidden" name="foto_lama" value="<?php echo $brg['foto']; ?>">
                        
                        <input type="hidden" name="tanda_tangan" value="<?php echo $brg['tanda_tangan']; ?>">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" 
                                       value="<?php echo htmlspecialchars($brg['nama_barang']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="makanan" <?php echo ($brg['kategori'] == 'makanan') ? 'selected' : ''; ?>>
                                        Makanan & Minuman
                                    </option>
                                    <option value="sembako" <?php echo ($brg['kategori'] == 'sembako') ? 'selected' : ''; ?>>
                                        Sembako
                                    </option>
                                    <option value="lainnya" <?php echo ($brg['kategori'] == 'lainnya') ? 'selected' : ''; ?>>
                                        Lain-lain
                                    </option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="sub_kategori" class="form-label">Sub-Kategori</label>
                                <select class="form-select" id="sub_kategori" name="sub_kategori" required>
                                    <option value="<?php echo $brg['sub_kategori']; ?>">
                                        <?php echo htmlspecialchars(ucfirst($brg['sub_kategori'])); ?> (Current)
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="stok" class="form-label">Jumlah Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" 
                                       value="<?php echo $brg['stok']; ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo htmlspecialchars($brg['deskripsi']); ?></textarea>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kondisi Barang</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kondisi" id="kondisi_baru" value="Baru" 
                                           <?php echo ($brg['kondisi'] == 'Baru') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="kondisi_baru">Baru</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kondisi" id="kondisi_bekas" value="Bekas"
                                           <?php echo ($brg['kondisi'] == 'Bekas') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="kondisi_bekas">Bekas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Opsi Tambahan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="opsi[]" value="Promo" id="opsi_promo"
                                           <?php echo in_array('Promo', $opsi_tersimpan) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="opsi_promo">Sedang Promo</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="opsi[]" value="Best Seller" id="opsi_best_seller"
                                           <?php echo in_array('Best Seller', $opsi_tersimpan) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="opsi_best_seller">Best Seller</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="foto" class="form-label">Ubah Foto Barang (Opsional)</label>
                            <div class="d-flex align-items-center">
                                <?php 
                                $fotoPath = BASE_URL . '/uploads/' . ($brg['foto'] && file_exists('uploads/' . $brg['foto']) ? $brg['foto'] : 'default.jpg');
                                ?>
                                <img src="<?php echo $fotoPath; ?>" class="img-fluid rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                <input class="form-control" type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div class="form-text">Kosongkan jika tidak ingin mengubah foto.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Tanda Tangan Petugas (Asli)</label>
                            <div>
                                <?php if ($brg['tanda_tangan']): ?>
                                    <img src="<?php echo $brg['tanda_tangan']; ?>" alt="Tanda Tangan" class="img-fluid rounded" style="background-color: #f0f0f0; max-height: 100px; border: 1px solid #ddd;">
                                <?php else: ?>
                                    <span class="text-muted">[Tidak ada tanda tangan]</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?php echo BASE_URL; ?>/barang" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-merah-madura" id="btn_submit">
                                Simpan Perubahan
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
