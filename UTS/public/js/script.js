function initializeLoginPage() {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    
    if (passwordInput && passwordToggle) {
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' 
                ? '<i class="fas fa-eye"></i>' 
                : '<i class="fas fa-eye-slash"></i>';
        });
    }
    
    const loginForm = document.querySelector('form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const btn = this.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
            btn.disabled = true;
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 5000);
        });
    }
    
    const logoCircle = document.querySelector('.logo-circle');
    if (logoCircle) {
        logoCircle.classList.add('floating');
    }
    
    const usernameField = document.getElementById('username');
    if (usernameField) {
        setTimeout(() => {
            usernameField.focus();
        }, 500);
    }
}

function initializeChainCombo() {
    const kategoriSelect = document.getElementById('kategori');
    const subKategoriSelect = document.getElementById('sub_kategori');
    if (kategoriSelect && subKategoriSelect) {
        kategoriSelect.addEventListener('change', function() {
            const selectedKategori = this.value;
            
            subKategoriSelect.innerHTML = '<option>Loading...</option>';
            subKategoriSelect.disabled = true;

            if (!selectedKategori) {
                subKategoriSelect.innerHTML 
 = '<option>-- Pilih kategori dulu --</option>';
                return;
            }

            fetch(`${BASE_URL}/barang/getSubKategori/${selectedKategori}`)
                .then(response => {
                    if (!response.ok) {
                         throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    subKategoriSelect.innerHTML = '';
                    
                    if (data.length > 0) {
                        subKategoriSelect.appendChild(new Option('-- Pilih Sub-Kategori --', ''));
 data.forEach(function(item) {
                            const option = document.createElement('option');
                            option.value = item.value;
                            option.textContent = item.text;
                            subKategoriSelect.appendChild(option);
                        });
 subKategoriSelect.disabled = false;
                    } else {
                        subKategoriSelect.innerHTML = '<option>-- Data tidak ditemukan --</option>';
 }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    subKategoriSelect.innerHTML = '<option>-- Gagal memuat data --</option>';
                });
        });
    }
}

function initializeCanvasSignature() {
    const canvas = document.getElementById('canvas_ttd');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
 canvas.width = canvas.offsetWidth;
        canvas.height = 200;
        ctx.strokeStyle = '#000000ff';
        ctx.lineWidth = 2;
        ctx.lineJoin = 'round';
        ctx.lineCap = 'round';
 function startDrawing(e) {
            isDrawing = true;
            draw(e);
 }

        function stopDrawing() {
            isDrawing = false;
 ctx.beginPath();
        }

        function draw(e) {
            if (!isDrawing) return;
 const rect = canvas.getBoundingClientRect();
            const x = (e.clientX || e.touches[0].clientX) - rect.left;
            const y = (e.clientY || e.touches[0].clientY) - rect.top;
 ctx.lineTo(x, y);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(x, y);
            
            e.preventDefault();
        }

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseout', stopDrawing);

        canvas.addEventListener('touchstart', startDrawing);
        canvas.addEventListener('touchend', stopDrawing);
        canvas.addEventListener('touchmove', draw);
        
        const clearButton = document.getElementById('btn_clear_canvas');
        if (clearButton) {
            clearButton.addEventListener('click', function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            });
        }

        const submitButton = document.getElementById('btn_submit');
        if (submitButton) {
            submitButton.addEventListener('click', function() {
                if (!isCanvasEmpty(ctx)) {
                    const dataURL = canvas.toDataURL('image/png');
                    document.getElementById('tanda_tangan_hidden').value = dataURL;
                } else {
                    document.getElementById('tanda_tangan_hidden').value = '';
                }
            });
        }
    }
}

function isCanvasEmpty(ctx) {
    const pixelBuffer = new Uint32Array(
        ctx.getImageData(0, 0, ctx.canvas.width, ctx.canvas.height).data.buffer
    );
    return !pixelBuffer.some(color => color !== 0);
}

function initializeDataTables() {
    if ($('#tabelInventaris').length) {
        $('#tabelInventaris').DataTable({
            dom: '<"row mb-3"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
            buttons: ['csv', 'excel', 'pdf', 'print'],
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
            }
        });
    }
}

$(document).ready(function() {
    initializeLoginPage();
    initializeChainCombo();
    initializeCanvasSignature();
    initializeDataTables();
});
