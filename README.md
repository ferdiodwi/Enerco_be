# EnergEco GlobalChain - Backend (API)

Backend repository untuk **EnergEco GlobalChain**, platform distribusi energi bersih yang cerdas dan terintegrasi untuk mendukung UMKM dan kolaborasi lokal. Dibangun menggunakan Laravel.

## 🚀 Teknologi yang Digunakan
* **Framework:** Laravel 13
* **Bahasa:** PHP 8.3+
* **Database:** MySQL
* **Autentikasi:** Laravel Sanctum (API Tokens)
* **Manajemen Hak Akses:** Spatie Laravel Permission

## 📦 Fitur Utama (Berdasarkan SRS)
1. **Role-Based Access Control (RBAC):** Mendukung 5 peran (Admin, UMKM, Government, Provider, Partner).
2. **Manajemen Energi & Kebutuhan:** API untuk entri ketersediaan *clean energy* dan pengajuan kebutuhan.
3. **AI Recommendation Engine:** API Rekomendasi (*matchmaking*) dengan *Priority Scoring* untuk distribusi energi.
4. **Data Geospasial (Peta Interaktif):** Endpoint yang menyediakan koordinat titik UMKM dan penyedia energi bersih.

---

## 🛠️ Cara Instalasi & Menjalankan Sistem

### 1. Persyaratan Sistem
Pastikan Anda sudah menginstal aplikasi berikut di komputer Anda:
* PHP >= 8.3
* Composer
* MySQL Database (XAMPP / Laragon / MySQL Server)

### 2. Langkah-langkah Instalasi

**Clone atau Ekstrak Project:**
Masuk ke direktori `Enerco_be` (repository ini).

**Install Dependencies:**
Jalankan perintah composer untuk menginstal semua *library* backend:
```bash
composer install
```

**Konfigurasi Environment (.env):**
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan atur koneksi database Anda (sesuaikan password jika ada):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=energeco
DB_USERNAME=root
DB_PASSWORD=
```
*(Catatan: Pastikan Anda telah membuat database kosong bernama `energeco` di phpMyAdmin / database client Anda).*

**Generate Application Key:**
```bash
php artisan key:generate
```

**Jalankan Migrasi & Seeder Database:**
Perintah ini akan membuat semua struktur tabel dan mengisi data awal (*dummy data*) termasuk Role, Permission, dan akun User.
```bash
php artisan migrate --seed
```
*(Catatan: Anda bisa melihat daftar akun demo yang dibuat di dalam file `database/seeders/DemoDataSeeder.php`)*.

**Buat Symlink untuk Storage (Penting untuk Gambar Marketplace):**
```bash
php artisan storage:link
```

### 3. Menjalankan Server API

Setelah instalasi selesai, jalankan server pengembangan Laravel:
```bash
php artisan serve
```
Backend API Anda sekarang berjalan di: **`http://127.0.0.1:8000`**

### 4. Menggunakan API (Telescope)
Untuk memonitor semua *request* API, *query* database, atau melihat pesan *error*, Anda bisa membuka *dashboard* Laravel Telescope di browser:
👉 **`http://127.0.0.1:8000/telescope`**

---
*Dikembangkan untuk solusi kompetisi.*
