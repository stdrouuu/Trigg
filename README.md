# 🎮 GamInc - E-Commerce Game Store

GamInc is a premium game store web application designed and built for the **Pemrograman Web II (Web Programming 2)** course. It features a fully responsive catalog, interactive shopping cart, favorites management, customer complaints section, checkout workflow, and a robust admin dashboard for store managers.

---

## 👤 Identitas Pengembang
* **Nama Mahasiswa:** Brandon Jeremiah Sutedja
* **NIM:** 412024022
* **Dosen Pengampu:** Benisius Anu, M.Cs.
* **Program Studi:** Informatika / Sistem Informasi

---

## 🛠️ Tech Stack & Fitur Utama

### Tech Stack
* **Backend:** PHP (Native OOP/Procedural routing, Session-based auth)
* **Frontend:** HTML5, Vanilla CSS (Premium dark mode aesthetic, glassmorphism, fluid animations), JavaScript (ES6)
* **Database:** MySQL / MariaDB
* **Libraries:** jQuery 3.7.1 (AJAX powered interactions), FontAwesome (Icons)

### Fitur Pengguna (Public Features)
1. **Catalog & Search:** Telusuri koleksi game premium berdasarkan kategori/platform, lengkap dengan fitur pencarian real-time.
2. **Interactive Shopping Cart:** Menambah, mengurangi, dan menghapus item langsung melalui sidebar drawer cart tanpa reload halaman.
3. **Favorites (Wishlist):** Simpan game favorit Anda untuk dibeli di kemudian hari.
4. **Checkout System:** Alur formulir pembelian yang aman dengan rekap order instan.
5. **Interactive FAQ:** Halaman tanya-jawab akordeon interaktif untuk bantuan cepat.
6. **Complaints Form:** Ajukan keluhan atau kendala transaksi langsung ke tim administrasi.

### Fitur Administrator (Admin Panel)
1. **Admin Dashboard:** Rekap data produk, pesanan masuk (*orders*), dan keluhan pelanggan.
2. **Product CRUD:** Tambah, edit, dan hapus data produk game secara langsung dengan upload gambar produk.
3. **Order Status Management:** Perbarui status transaksi pelanggan (*pending, processing, shipped, delivered*).
4. **Complaint Resolution:** Tinjau pesan keluhan dari pelanggan dan tandai keluhan sebagai diselesaikan (*resolved*).

---

## 🔐 Akun & Kredensial Pengujian

### 1. Akun Public (Customer)
* **URL:** `http://localhost/412024022_BRANDON_JEREMIAH/auth`
* **Username:** `brandon`
* **Password:** `1234`

### 2. Akun Administrator
* **URL:** `http://localhost/412024022_BRANDON_JEREMIAH/admin`
* **Username:** `admin`
* **Password:** `admin123`

---

## 🚀 Panduan Instalasi Lokal

### Prasyarat
1. Server lokal seperti **Laragon** (sangat direkomendasikan) atau **XAMPP**.
2. PHP versi 7.4 ke atas.
3. MySQL Database.

### Langkah-langkah Setup
1. **Clone/Salin Project:**
   Tempatkan folder proyek `412024022_BRANDON_JEREMIAH` ke dalam direktori root server lokal Anda:
   * **Laragon:** `C:\laragon\www\`
   * **XAMPP:** `C:\xampp\htdocs\`

2. **Import Database:**
   * Buka **phpMyAdmin** atau client database favorit Anda (HeidiSQL/DBeaver).
   * Buat database baru dengan nama `20222_wp2_412024022`.
   * Import file SQL yang berada di dalam proyek: `config/20222_wp2_412024022.sql`.

3. **Konfigurasi Koneksi:**
   Buka file `config/db_conn.php` dan pastikan kredensial server lokal Anda sesuai:
   ```php
   $servername = "127.0.0.1";
   $username = "root";
   $password = "";
   $dbname = "20222_wp2_412024022";
   ```

4. **Jalankan Aplikasi:**
   Buka browser Anda dan akses:
   * Public Web: `http://localhost/412024022_BRANDON_JEREMIAH/`
   * Admin Web: `http://localhost/412024022_BRANDON_JEREMIAH/admin`

---

## 📂 Struktur Direktori Utama

```text
├── administrator/          # File khusus administrator (Halaman Dashboard, Login, & API Admin)
│   ├── api/                # API handler untuk admin (auth, orders, products)
│   └── pages/              # Tampilan halaman admin (dashboard, login)
├── api/                    # API handler untuk pengguna publik (auth, cart, orders, dll)
├── assets/                 # Aset aplikasi
│   ├── css/                # Styling CSS (Navbar, Footer, Modul Halaman)
│   ├── img/                # Gambar produk & dekorasi UI
│   └── js/                 # Logika JavaScript & jQuery AJAX
├── components/             # Komponen UI global (Navbar, Footer, Head)
├── config/                 # File konfigurasi database & file migrasi SQL
├── pages/                  # Tampilan halaman publik (Home, Auth, Cart, Product, FAQ, dll)
├── .htaccess               # Konfigurasi routing & URL Rewriting
├── index.php               # Halaman utama & handler router aplikasi
└── README.md               # Dokumentasi proyek
```