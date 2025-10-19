<div class="container my-4 fade-in">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-card">
                <div class="form-header">
            
                    <h2 class="text-center">
                        <i class="fas fa-plus-circle me-2"></i>Formulir Input Barang Baru
                    </h2>
                </div>
                <div class="form-body">
        
                    <?php Flasher::flash(); ?>
                    
                    <form action="<?php echo BASE_URL; ?>/barang/prosesTambah" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="tanda_tangan" id="tanda_tangan_hidden">

   
                         <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_barang" class="form-label-custom">Nama Barang</label>
             
                                <input type="text" class="form-control form-control-custom" id="nama_barang" name="nama_barang" required>
                            </div>
                            <div class="col-md-6">
                  
                                <label for="kategori" class="form-label-custom">Kategori</label>
                                <select class="form-select form-control-custom" id="kategori" name="kategori" required>
                                    <option value="">-- Pilih Kategori --</option>
       
                                    <option value="makanan">Makanan & Minuman</option>
                                    <option value="sembako">Sembako</option>
                               
                                    <option value="lainnya">Lain-lain</option>
                                </select>
                            </div>
                        </div>
          
                         
                        <div class="row mb-3">
                            <div class="col-md-6">
                               
                                <label for="sub_kategori" class="form-label-custom">Sub-Kategori</label>
                                <select class="form-select form-control-custom" id="sub_kategori" name="sub_kategori" disabled required>
                                    <option>-- Pilih kategori dulu --</option>
                   
                                </select>
                            </div>
                            <div class="col-md-6">
                              
                                <label for="stok" class="form-label-custom">Jumlah Stok</label>
                                <input type="number" class="form-control form-control-custom" id="stok" name="stok" required>
                            </div>
                        </div>
     
                         
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label-custom">Deskripsi Barang</label>
                         
                            <textarea class="form-control form-control-custom" id="deskripsi" name="deskripsi" rows="6"></textarea>
                        </div>
                        
                        <div class="row mb-3">
                  
                            <div class="col-md-6">
                                <label class="form-label-custom">Kondisi Barang</label>
                                <div class="form-check">
                      
                                    <input class="form-check-input" type="radio" name="kondisi" id="kondisi_baru" value="Baru" checked>
                                    <label class="form-check-label" for="kondisi_baru">Baru</label>
                                </div>
          
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kondisi" id="kondisi_bekas" value="Bekas">
                                    
                                    <label class="form-check-label" for="kondisi_bekas">Bekas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
         
                                <label class="form-label-custom">Opsi Tambahan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="opsi[]" value="Promo" id="opsi_promo">
 
                                    <label class="form-check-label" for="opsi_promo">Sedang Promo</label>
                                </div>
                              
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="opsi[]" value="Best Seller" id="opsi_best_seller">
                                    <label class="form-check-label" for="opsi_best_seller">Best Seller</label>
                
                                </div>
                            </div>
                        </div>
                        
        
                         <div class="mb-3">
                            <label for="foto" class="form-label-custom">Upload Foto Barang</label>
                            <input class="form-control form-control-custom" type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg">
               
                            <div class="form-text">Maks 2MB.
 Format: jpg, jpeg, png.</div>
                        </div>
                        
                        <div class="mb-3">
                        
                            <label for="canvas_ttd" class="form-label-custom">Tanda Tangan Petugas</label>
                            <canvas id="canvas_ttd" class="canvas-box"></canvas>
                            <button type="button" id="btn_clear_canvas" class="btn btn-outline-custom mt-2">Hapus TTD</button>
                        </div>

    
                         <hr class="my-4">

                        <div class="form-action-buttons">
                            <a href="<?php echo BASE_URL; ?>/barang" class="btn btn-outline-custom me-md-2">
                
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                            <button type="submit" class="btn btn-merah-madura" id="btn_submit">
                   
                                <i class="fas fa-save me-2"></i>Simpan Data Barang
                            </button>
                        </div>
                        
      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>