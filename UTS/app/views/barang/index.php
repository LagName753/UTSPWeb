<div class="container my-4 fade-in">
    <div class="dashboard-header rounded-3 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
    
                    <h1 class="heading-font mb-2">Dashboard Inventaris</h1>
                    <p class="mb-0 opacity-75">Kelola data barang toko dengan mudah</p>
                </div>
                <div class="col-md-4 text-end">
                    
                    <a href="<?php echo BASE_URL; ?>/barang/tambah" class="btn btn-tambah-barang">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Barang Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php 
 Flasher::flash(); ?>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number"><?php echo count($data['barang']); ?></div>
                <div class="stats-label">Total Barang</div>
            </div>
        </div>
      
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">
                    <?php 
                    $totalStok = 0;
                    foreach($data['barang'] as $brg) {
 
                        $totalStok += $brg['stok'];
                    }
                    echo $totalStok;
                    ?>
              
                </div>
                <div class="stats-label">Total Stok</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">
                    <?php
 
                        $kategori = array_count_values(array_column($data['barang'], 'kategori'));
 echo count($kategori);
                    ?>
                </div>
                <div class="stats-label">Kategori</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number text-success">
     
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-label">Sistem Aktif</div>
            </div>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="card-header-custom">
    
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="heading-font m-0">Daftar Inventaris Barang</h3>
                <div>
                    <span class="badge badge-custom badge-new me-2">
                        <i class="fas fa-box me-1"></i><?php echo 
 count($data['barang']); ?> Items
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <table id="tabelInventaris" class="table table-custom table-hover" style="width:100%">
               
                 <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
      
                        <th>Kategori</th>
                        <th>Sub-Kategori</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
          
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
             
                    $no = 1;
 foreach ($data['barang'] as $brg) : 
                    ?>
                        <tr>
                            <td class="fw-bold"><?php echo $no++;
 ?></td>
                            <td>
                                <?php 
                                $fotoPath = BASE_URL .
 '/uploads/' . ($brg['foto'] && file_exists('uploads/' . $brg['foto']) ? $brg['foto'] : 'default.jpg');
 ?>
                                <img src="<?php echo $fotoPath; ?>" 
                                     alt="Foto" class="img-thumbnail-custom" 
                        
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                          
                                <div class="fw-bold"><?php echo htmlspecialchars($brg['nama_barang']);
 ?></div>
                                <small class="text-muted"><?php echo substr(htmlspecialchars($brg['deskripsi']), 0, 50);
 ?>...</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark"><?php echo htmlspecialchars($brg['kategori']);
 ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($brg['sub_kategori']);
 ?></td>
                            <td>
                                <span class="fw-bold <?php echo $brg['stok'] < 10 ? 'text-danger' : 'text-success'; ?>">
                             
                                    <?php echo htmlspecialchars($brg['stok']);
 ?>
                                </span>
                            </td>
                            <td>
            
                                <?php if($brg['kondisi'] == 'Baru'): ?>
                                    <span class="badge badge-custom badge-new">Baru</span>
                                <?php else: ?>
   
                                    <span class="badge badge-custom badge-used">Bekas</span>
                                <?php endif;
 ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
          
                                    <a href="<?php echo BASE_URL; ?>/barang/edit/<?php echo $brg['id']; ?>" 
                                       class="btn btn-warning btn-action">
                         
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/barang/hapus/<?php echo $brg['id']; ?>" 
   
                                        class="btn btn-danger btn-action" 
                                       onclick="return confirm('Yakin ingin menghapus data ini?');">
                 
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
       
                            </td>
                        </tr>
                    <?php endforeach;
 ?>
                </tbody>
            </table>
        </div>
    </div>
</div>