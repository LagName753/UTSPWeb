<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo $data['judul']; ?> - Inventaris Toko Madura</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
</head>
<body class="login-body">

    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            <div class="col-md-6 d-flex align-items-end login-image-side">
                <div class="image-overlay w-100">
                    <h3>Toko Madura</h3>
                    <p>Solusi inventaris terpercaya</p>
                </div>
            </div>
            
            <div class="col-md-6 d-flex align-items-center justify-content-center login-form-side">
                <div class="login-form-container">
                    <div class="brand-header text-center mb-4">
                        <div class="logo-circle mb-3">
                            <i class="fas fa-store"></i>
                        </div>
                        <h1 class="heading-font">Selamat Datang</h1>
                        <p class="app-subtitle">Aplikasi Inventaris Toko</p>
                    </div>

                    <?php Flasher::flash(); ?>

                    <form action="<?php echo BASE_URL; ?>/auth/prosesLogin" method="POST" class="w-100">
                        <div class="form-floating mb-3 position-relative">
                            <input type="text" class="form-control ps-5" id="username" name="username" 
                                   placeholder="Username" required value="<?php echo $_POST['username'] ?? ''; ?>">
                            <label for="username" class="ps-5">Username</label>
                            <div class="input-icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control ps-5" id="password" name="password" 
                                   placeholder="Password" required>
                            <label for="password" class="ps-5">Password</label>
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <button type="button" class="password-toggle btn btn-link p-0" id="passwordToggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        <div class="d-grid mt-4">
                            <button class="btn btn-login btn-lg" type="submit">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Gunakan username dan password yang telah diberikan
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/js/script.js"></script>
</body>
</html>
