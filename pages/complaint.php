<link rel="stylesheet" href="./assets/css/complaint-style.css" />

<!-- Hero Section Full Width -->
<div class="complaint-hero-full-width">
    <div class="complaint-hero-content">
        <h1 class="complaint-hero-title">Kirimkan <span style="color: #A0C4FF;">Komplain</span><br> & Hubungi Kami</h1>
    </div>
</div>

<!-- Gradient Divider -->
<div class="complaint-divider-container">
    <div class="complaint-gradient-line"></div>
</div>

<div class="user-container complaint-layout-container">
    <div class="complaint-grid">
        <!-- Left column: Info card -->
        <div class="complaint-info-card">
            <div class="complaint-card-header">
                <h3 class="complaint-card-title">Informasi Bantuan</h3>
            </div>
            <div class="complaint-card-divider"></div>
            <div class="complaint-info-content">
                <p>Tim dukungan kami siap membantu Anda menyelesaikan kendala transaksi atau akun.</p>
                <div class="complaint-info-item">
                    <i class="fa-solid fa-clock"></i>
                    <div>
                        <strong>Waktu Respon</strong>
                        <span>> Kurang dari 24 Jam</span>
                    </div>
                </div>
                <div class="complaint-info-item">
                    <i class="fa-solid fa-envelope"></i>
                    <div>
                        <strong>Email Dukungan</strong>
                        <span>> support@gaminc.com</span>
                    </div>
                </div>
                <div class="complaint-info-item">
                    <i class="fa-solid fa-circle-question"></i>
                    <div>
                        <strong>Butuh Jawaban Cepat?</strong>
                        <span>>Coba cek halaman <a href="faq" style="color: #A0C4FF; text-decoration: none;">FAQ kami</a> terlebih dahulu.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right column: Form card -->
        <div class="complaint-form-card" id="complaintFormCard">
            <form id="complaintForm">
                <div class="form-group">
                    <label for="complaintCategory">Kategori <span style="color:#ef4444">*</span></label>
                    <select id="complaintCategory" name="category" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        <option value="Masalah Pembayaran">Masalah Pembayaran</option>
                        <option value="Item yang Diterima Salah">Item yang Diterima Salah</option>
                        <option value="Masalah Pengiriman">Masalah Pengiriman</option>
                        <option value="Permintaan Refund">Permintaan Refund</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="complaintOrderId">Order ID <span style="color:#a1a1aa; font-weight:400;">(opsional)</span></label>
                    <input type="number" id="complaintOrderId" name="order_id" placeholder="contoh: 42 — biarkan kosong jika tidak ada" min="1" />
                    <div class="form-hint">Temukan Order ID Anda di "Pesanan Saya"</div>
                </div>

                <div class="form-group">
                    <label for="complaintMessage">Deskripsikan kendala Anda <span style="color:#ef4444">*</span></label>
                    <textarea id="complaintMessage" name="message" placeholder="Berikan detail sebanyak mungkin" required></textarea>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> Kirim Komplain
                </button>
            </form>
        </div>
    </div>

    <!-- Success State -->
    <div class="complaint-success" id="complaintSuccess">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h2>Komplain Berhasil Dikirim!</h2>
        <p>Komplain Anda telah kami terima. Tim kami akan meninjau dan menghubungi Anda kembali dalam waktu 24 jam.</p>
        <a href="user" class="btn-back-home">Kembali ke Akun</a>
    </div>
</div>

<script src="assets/js/complaint.js"></script>