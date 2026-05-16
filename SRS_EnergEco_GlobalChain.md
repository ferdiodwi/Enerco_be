# Software Requirements Specification (SRS)
# EnergEco GlobalChain

**Nama Sistem:** EnergEco GlobalChain  
**Jenis Sistem:** Sistem Informasi Web Berbasis AI  
**Versi Dokumen:** 1.0  
**Tanggal:** 15 Mei 2026  
**Target Pengembangan:** Demo Hackathon Web Application  
**Tech Stack Utama:** Laravel 13, MySQL 8, React, Vite, TypeScript, Tailwind CSS, AI API  

---

## Riwayat Revisi

| Versi | Tanggal | Deskripsi | Penulis |
|---|---|---|---|
| 1.0 | 15 Mei 2026 | Dokumen awal SRS EnergEco GlobalChain | Tim Pengembang |

---

## 1. Pendahuluan

### 1.1 Tujuan Dokumen

Dokumen Software Requirements Specification (SRS) ini disusun untuk menjelaskan kebutuhan perangkat lunak dari sistem **EnergEco GlobalChain**, yaitu sistem informasi web berbasis AI yang membantu pemetaan, pemantauan, rekomendasi, dan optimasi distribusi energi bersih untuk mendukung transformasi ekonomi lokal berkelanjutan.

Dokumen ini menjadi acuan utama bagi tim pengembang dalam proses analisis, desain, implementasi, pengujian, deployment, dan presentasi demo sistem.

### 1.2 Ruang Lingkup Sistem

EnergEco GlobalChain adalah platform berbasis web yang menghubungkan beberapa pihak dalam ekosistem energi bersih dan ekonomi lokal, yaitu:

1. Admin sistem.
2. Pelaku UMKM.
3. Pemerintah daerah.
4. Penyedia energi bersih.
5. Investor atau mitra strategis.

Sistem ini menyediakan fitur utama berupa:

- Manajemen data UMKM.
- Manajemen sumber energi bersih.
- Pemetaan lokasi UMKM dan sumber energi.
- Prediksi kebutuhan energi.
- Skoring prioritas bantuan energi.
- Rekomendasi distribusi energi berbasis AI.
- Monitoring dampak ekonomi dan lingkungan.
- Marketplace produk lokal.
- Pengajuan kemitraan.
- Dashboard berbasis role.

### 1.3 Latar Belakang

Distribusi energi bersih masih menghadapi tantangan besar, terutama dalam pemerataan akses bagi pelaku ekonomi lokal seperti UMKM. Banyak UMKM memiliki kebutuhan energi yang besar, tetapi belum memiliki akses terhadap sumber energi yang efisien, terjangkau, dan ramah lingkungan.

Selain itu, data potensi energi terbarukan, kebutuhan energi UMKM, dampak ekonomi, dan prioritas distribusi sering kali belum terintegrasi dalam satu sistem digital. Akibatnya, pengambilan keputusan terkait distribusi energi bersih belum sepenuhnya berbasis data.

EnergEco GlobalChain hadir sebagai solusi digital berbasis AI untuk membantu proses pemetaan, analisis, rekomendasi, dan monitoring distribusi energi bersih agar lebih tepat sasaran, adil, dan berdampak terhadap ekonomi lokal.

### 1.4 Tujuan Sistem

Tujuan utama sistem adalah:

1. Membantu pemetaan sumber energi bersih dan pelaku ekonomi lokal.
2. Membantu UMKM mengajukan kebutuhan energi bersih.
3. Membantu pemerintah daerah melihat wilayah dan sektor prioritas.
4. Membantu penyedia energi dalam menentukan target distribusi.
5. Membantu mitra atau investor menemukan UMKM potensial.
6. Menghasilkan rekomendasi distribusi energi berbasis AI.
7. Mengukur dampak berupa penghematan biaya, peningkatan produktivitas, dan estimasi pengurangan emisi.
8. Mendukung pencapaian SDG 1, SDG 7, SDG 9, dan SDG 17.

### 1.5 Definisi, Akronim, dan Singkatan

| Istilah | Definisi |
|---|---|
| SRS | Software Requirements Specification |
| AI | Artificial Intelligence atau kecerdasan buatan |
| UMKM | Usaha Mikro, Kecil, dan Menengah |
| SDG | Sustainable Development Goals |
| REST API | Arsitektur API berbasis HTTP |
| MVP | Minimum Viable Product |
| kWh | Kilowatt-hour, satuan konsumsi energi |
| Emisi | Gas buang karbon yang dihasilkan dari penggunaan energi |
| Priority Score | Skor prioritas distribusi energi |
| Dashboard | Tampilan ringkasan data dan visualisasi |
| Marketplace | Halaman katalog produk UMKM |
| Role | Peran pengguna dalam sistem |
| Token | Kode autentikasi untuk akses API |

### 1.6 Referensi

1. Pedoman PLAY IT! 2026 kategori Hackathon Web Application.
2. Dokumentasi Laravel 13.
3. Dokumentasi React.
4. Dokumentasi MySQL.
5. Dokumentasi Tailwind CSS.
6. Dokumentasi React Leaflet.
7. Dokumentasi Recharts.
8. Dokumentasi Gemini API atau OpenAI API.

### 1.7 Gambaran Umum Dokumen

Dokumen ini terdiri dari beberapa bagian utama:

- Pendahuluan.
- Deskripsi umum sistem.
- Kebutuhan fungsional.
- Kebutuhan non-fungsional.
- Role dan hak akses.
- Use case.
- Rancangan data.
- Rancangan API.
- Rancangan UI/UX.
- Kebutuhan AI.
- Kebutuhan deployment.
- Acceptance criteria.

---

## 2. Deskripsi Umum Sistem

### 2.1 Perspektif Produk

EnergEco GlobalChain merupakan aplikasi web modern berbasis client-server. Sistem terdiri dari dua bagian utama:

1. **Frontend React**
   - Menyediakan antarmuka pengguna untuk public page, admin dashboard, UMKM dashboard, pemerintah dashboard, penyedia energi dashboard, partner dashboard, marketplace, peta, dan AI recommendation view.

2. **Backend Laravel 13**
   - Menyediakan REST API, autentikasi, manajemen role, validasi data, logika bisnis, integrasi AI, perhitungan skor prioritas, pengelolaan database, dan proses background job.

3. **Database MySQL**
   - Menyimpan data user, UMKM, sumber energi, kebutuhan energi, rekomendasi, distribusi, dampak, produk, dan kemitraan.

### 2.2 Arsitektur Umum

```text
+---------------------------+
| React Frontend            |
| - Landing Page            |
| - Admin Dashboard         |
| - UMKM Dashboard          |
| - Government Dashboard    |
| - Provider Dashboard      |
| - Partner Dashboard       |
| - Marketplace             |
| - Map & Chart             |
+------------+--------------+
             |
             | REST API / JSON
             |
+------------v--------------+
| Laravel 13 Backend API     |
| - Auth & Role              |
| - CRUD Service             |
| - AI Recommendation        |
| - Priority Scoring         |
| - Impact Calculation       |
| - Report Service           |
| - Queue & Scheduler        |
+------------+--------------+
             |
             |
+------------v--------------+
| MySQL 8 Database           |
+---------------------------+
```

### 2.3 Fungsi Utama Sistem

Sistem memiliki fungsi utama sebagai berikut:

1. Autentikasi dan otorisasi multi-role.
2. Manajemen data UMKM.
3. Manajemen data sumber energi bersih.
4. Manajemen data kebutuhan energi.
5. Pemetaan lokasi UMKM dan sumber energi.
6. Perhitungan jarak antara UMKM dan sumber energi.
7. Perhitungan skor prioritas.
8. Rekomendasi distribusi energi berbasis AI.
9. Monitoring dampak ekonomi dan lingkungan.
10. Marketplace produk lokal.
11. Pengajuan dan pengelolaan kemitraan.
12. Dashboard analitik berdasarkan role pengguna.
13. Export laporan.
14. Dokumentasi API.

### 2.4 Karakteristik Pengguna

#### 2.4.1 Admin

Admin adalah pengelola utama sistem yang bertugas mengatur data, memvalidasi pengguna, memantau rekomendasi AI, mengelola laporan, dan memastikan sistem berjalan dengan baik.

#### 2.4.2 UMKM

UMKM adalah pelaku usaha lokal yang menggunakan sistem untuk mendaftarkan usaha, mengisi kebutuhan energi, melihat rekomendasi, mengunggah produk, dan mengajukan kemitraan.

#### 2.4.3 Pemerintah Daerah

Pemerintah daerah menggunakan sistem untuk melihat peta kebutuhan energi, wilayah prioritas, laporan dampak, dan rekomendasi distribusi energi.

#### 2.4.4 Penyedia Energi

Penyedia energi adalah pihak yang memiliki atau mengelola sumber energi bersih, seperti tenaga surya, air, angin, biomassa, atau energi terbarukan lainnya.

#### 2.4.5 Investor/Mitra

Investor atau mitra adalah pihak yang ingin berkolaborasi dengan UMKM, penyedia energi, koperasi, atau pemerintah daerah dalam mendukung distribusi energi bersih dan ekonomi lokal.

### 2.5 Batasan Sistem

Batasan sistem pada versi demo:

1. Sistem menggunakan data simulasi atau dataset contoh.
2. AI tidak melakukan machine learning training dari awal.
3. AI menggunakan pendekatan hybrid, yaitu rule-based scoring dan AI-generated insight.
4. Peta menggunakan koordinat latitude dan longitude.
5. Sistem belum terintegrasi langsung dengan sensor IoT.
6. Transaksi marketplace belum sampai pembayaran online.
7. Validasi data masih dilakukan oleh admin melalui dashboard.
8. Perhitungan emisi masih berupa estimasi berdasarkan faktor emisi sederhana.
9. Sistem difokuskan untuk demo web application, bukan aplikasi mobile.

### 2.6 Asumsi dan Ketergantungan

Asumsi:

1. Pengguna memiliki akses internet.
2. Data UMKM dan sumber energi dapat dimasukkan secara manual.
3. Admin bertanggung jawab memvalidasi data.
4. AI API tersedia selama proses demo.
5. Server backend dan frontend berjalan normal.

Ketergantungan:

1. Laravel 13 membutuhkan PHP minimal 8.3.
2. Frontend membutuhkan Node.js.
3. Database menggunakan MySQL 8.
4. Fitur AI membutuhkan API key dari Gemini API atau OpenAI API.
5. Peta membutuhkan layanan tile dari OpenStreetMap.
6. Deployment membutuhkan VPS atau cloud hosting.

---

## 3. Kebutuhan Teknologi

### 3.1 Backend

| Komponen | Teknologi |
|---|---|
| Framework | Laravel 13 |
| Bahasa | PHP 8.3+ |
| Database | MySQL 8 |
| Auth API | Laravel Sanctum |
| Role & Permission | Spatie Laravel Permission |
| Queue | Laravel Queue |
| Cache | Redis |
| Scheduler | Laravel Scheduler |
| API Documentation | Scribe atau Swagger |
| Testing | Pest PHP |
| Error Tracking | Sentry |
| Debug Tool | Laravel Telescope |
| File Storage | Laravel Storage |
| Export PDF | DomPDF |
| Export Excel | Laravel Excel |

### 3.2 Frontend

| Komponen | Teknologi |
|---|---|
| Framework | React |
| Build Tool | Vite |
| Bahasa | TypeScript |
| Styling | Tailwind CSS |
| UI Component | shadcn/ui |
| Routing | React Router |
| API Request | Axios |
| Server State | TanStack Query |
| Form Handling | React Hook Form |
| Validation | Zod |
| Chart | Recharts |
| Map | React Leaflet |
| Animation | Framer Motion |
| Icon | Lucide React |
| Table | TanStack Table |
| Notification | Sonner |

### 3.3 AI

| Kebutuhan | Teknologi |
|---|---|
| AI Text Insight | Gemini API atau OpenAI API |
| AI Integration | Laravel HTTP Client |
| Scoring | Laravel Service Class |
| Background Processing | Laravel Job + Queue |
| Prompt Template | Stored prompt di backend |

### 3.4 Deployment

| Komponen | Teknologi |
|---|---|
| Backend Hosting | VPS Ubuntu |
| Web Server | Nginx |
| PHP Runtime | PHP-FPM 8.3+ |
| Database Server | MySQL 8 |
| Frontend Hosting | Vercel |
| SSL | Certbot |
| Process Manager | Supervisor |
| Version Control | GitHub |
| CI/CD Opsional | GitHub Actions |

---

## 4. User Role dan Hak Akses

### 4.1 Daftar Role

| Role | Deskripsi |
|---|---|
| Admin | Mengelola seluruh data dan konfigurasi sistem |
| UMKM | Mengelola profil usaha, kebutuhan energi, produk, dan pengajuan |
| Government | Melihat peta, prioritas wilayah, dan laporan dampak |
| Energy Provider | Mengelola sumber energi dan status distribusi |
| Partner | Melihat peluang kemitraan dan mengajukan kerja sama |

### 4.2 Matriks Hak Akses

| Fitur | Admin | UMKM | Government | Provider | Partner |
|---|---|---|---|---|---|
| Login | Ya | Ya | Ya | Ya | Ya |
| Register | Ya | Ya | Ya | Ya | Ya |
| Kelola User | Ya | Tidak | Tidak | Tidak | Tidak |
| Kelola UMKM | Ya | Data sendiri | Lihat | Lihat | Lihat |
| Validasi UMKM | Ya | Tidak | Tidak | Tidak | Tidak |
| Kelola Sumber Energi | Ya | Tidak | Lihat | Data sendiri | Lihat |
| Kelola Kebutuhan Energi | Ya | Data sendiri | Lihat | Lihat | Tidak |
| Lihat Peta Energi | Ya | Ya | Ya | Ya | Ya |
| Generate Rekomendasi AI | Ya | Tidak | Ya | Ya | Tidak |
| Lihat Rekomendasi | Ya | Data sendiri | Ya | Ya | Terbatas |
| Kelola Produk | Ya | Data sendiri | Tidak | Tidak | Lihat |
| Kelola Kemitraan | Ya | Data sendiri | Lihat | Data sendiri | Data sendiri |
| Laporan Dampak | Ya | Data sendiri | Ya | Ya | Terbatas |
| Export Laporan | Ya | Tidak | Ya | Ya | Tidak |

---

## 5. Kebutuhan Fungsional

### 5.1 Modul Autentikasi

#### FR-AUTH-001 Register Pengguna

Sistem harus menyediakan fitur pendaftaran pengguna.

Input:

- Nama.
- Email.
- Password.
- Konfirmasi password.
- Role pengguna.
- Nomor telepon.
- Alamat.

Output:

- Akun pengguna berhasil dibuat.
- Token autentikasi diberikan setelah login.

Validasi:

- Email wajib unik.
- Password minimal 8 karakter.
- Role wajib sesuai daftar role yang tersedia.
- Email harus valid.

#### FR-AUTH-002 Login Pengguna

Sistem harus menyediakan fitur login.

Input:

- Email.
- Password.

Output:

- Token autentikasi.
- Data user.
- Role user.
- Redirect ke dashboard sesuai role.

#### FR-AUTH-003 Logout Pengguna

Sistem harus menyediakan fitur logout.

Output:

- Token dihapus.
- User keluar dari sistem.

#### FR-AUTH-004 Proteksi Route

Sistem harus membatasi akses halaman berdasarkan role.

Contoh:

- `/admin/*` hanya untuk admin.
- `/umkm/*` hanya untuk UMKM.
- `/government/*` hanya untuk pemerintah.
- `/provider/*` hanya untuk penyedia energi.
- `/partner/*` hanya untuk partner.

---

### 5.2 Modul User Management

#### FR-USER-001 Melihat Daftar User

Admin dapat melihat daftar seluruh user.

Fitur:

- Search user.
- Filter berdasarkan role.
- Filter berdasarkan status.
- Pagination.
- Sorting.

#### FR-USER-002 Mengubah Status User

Admin dapat mengubah status user menjadi:

- Active.
- Pending.
- Suspended.

#### FR-USER-003 Menghapus User

Admin dapat menghapus user yang tidak valid.

#### FR-USER-004 Mengubah Role User

Admin dapat mengubah role user apabila terjadi kesalahan pendaftaran.

---

### 5.3 Modul UMKM

#### FR-BUS-001 Membuat Profil UMKM

User role UMKM dapat membuat profil usaha.

Input:

- Nama usaha.
- Sektor usaha.
- Deskripsi.
- Alamat.
- Latitude.
- Longitude.
- Jumlah pekerja.
- Kapasitas produksi.
- Biaya energi bulanan.
- Kebutuhan energi bulanan.
- Foto usaha.
- Status akses energi bersih.

Output:

- Profil UMKM tersimpan.
- Status validasi default: pending.

#### FR-BUS-002 Mengubah Profil UMKM

UMKM dapat mengubah profil usaha miliknya.

#### FR-BUS-003 Melihat Profil UMKM

UMKM dapat melihat profil usahanya, sedangkan admin dan pemerintah dapat melihat seluruh data UMKM.

#### FR-BUS-004 Validasi UMKM

Admin dapat memvalidasi data UMKM.

Status validasi:

- Pending.
- Verified.
- Rejected.

#### FR-BUS-005 Menghapus UMKM

Admin dapat menghapus data UMKM. UMKM hanya dapat menghapus data sendiri jika belum tervalidasi.

---

### 5.4 Modul Sumber Energi Bersih

#### FR-ENERGY-001 Menambah Sumber Energi

Penyedia energi atau admin dapat menambah data sumber energi.

Input:

- Nama sumber energi.
- Jenis energi.
- Deskripsi.
- Alamat.
- Latitude.
- Longitude.
- Kapasitas total kWh.
- Kapasitas tersedia kWh.
- Status operasional.
- Pemilik atau penyedia.
- Foto atau dokumen pendukung.

Jenis energi:

- Solar.
- Wind.
- Hydro.
- Biomass.
- Geothermal.
- Other.

#### FR-ENERGY-002 Mengubah Sumber Energi

Penyedia energi dapat mengubah sumber energi miliknya. Admin dapat mengubah semua data.

#### FR-ENERGY-003 Menghapus Sumber Energi

Admin dapat menghapus sumber energi. Penyedia energi dapat menghapus data miliknya jika belum digunakan dalam distribusi.

#### FR-ENERGY-004 Melihat Sumber Energi

Semua role dapat melihat daftar sumber energi, tetapi detail tertentu dapat dibatasi.

#### FR-ENERGY-005 Update Kapasitas Energi

Penyedia energi dapat memperbarui kapasitas tersedia.

---

### 5.5 Modul Kebutuhan Energi

#### FR-NEED-001 Input Kebutuhan Energi

UMKM dapat menginput kebutuhan energi.

Input:

- Business ID.
- Periode.
- Kebutuhan energi kWh.
- Jam operasional.
- Peralatan utama.
- Biaya energi saat ini.
- Masalah energi yang dihadapi.

#### FR-NEED-002 Riwayat Kebutuhan Energi

UMKM dapat melihat riwayat kebutuhan energi setiap periode.

#### FR-NEED-003 Validasi Kebutuhan Energi

Admin dapat memvalidasi data kebutuhan energi yang diajukan UMKM.

---

### 5.6 Modul Peta Energi dan UMKM

#### FR-MAP-001 Menampilkan Peta

Sistem harus menampilkan peta interaktif.

Layer peta:

- Lokasi UMKM.
- Lokasi sumber energi.
- Wilayah prioritas.
- Jalur distribusi.

#### FR-MAP-002 Filter Peta

Pengguna dapat memfilter peta berdasarkan:

- Jenis energi.
- Sektor UMKM.
- Wilayah.
- Priority score.
- Status validasi.
- Status distribusi.

#### FR-MAP-003 Detail Marker

Ketika marker diklik, sistem menampilkan informasi singkat:

- Nama lokasi.
- Jenis data.
- Kapasitas atau kebutuhan energi.
- Status.
- Skor prioritas.

---

### 5.7 Modul Skoring Prioritas

#### FR-SCORE-001 Menghitung Priority Score

Sistem harus menghitung skor prioritas UMKM atau wilayah berdasarkan beberapa parameter.

Parameter:

- Kebutuhan energi.
- Biaya energi saat ini.
- Jumlah pekerja.
- Kapasitas produksi.
- Jarak ke sumber energi.
- Potensi pengurangan emisi.
- Dampak ekonomi.
- Status akses energi bersih.
- Urgensi wilayah.

Contoh formula awal:

```text
priority_score =
(energy_need_score * 0.25) +
(economic_impact_score * 0.20) +
(worker_score * 0.15) +
(distance_score * 0.15) +
(emission_reduction_score * 0.15) +
(clean_energy_access_score * 0.10)
```

#### FR-SCORE-002 Kategori Skor

Sistem harus mengelompokkan skor:

| Skor | Kategori |
|---|---|
| 80 - 100 | Sangat Prioritas |
| 60 - 79 | Prioritas |
| 40 - 59 | Menengah |
| 0 - 39 | Rendah |

#### FR-SCORE-003 Menyimpan Hasil Skor

Setiap hasil perhitungan skor harus disimpan ke database untuk histori dan audit.

---

### 5.8 Modul AI Recommendation Engine

#### FR-AI-001 Generate Rekomendasi Distribusi

Sistem harus menghasilkan rekomendasi distribusi energi berdasarkan data UMKM, sumber energi, kebutuhan energi, jarak, kapasitas, dan skor prioritas.

Output:

- UMKM prioritas.
- Sumber energi yang direkomendasikan.
- Estimasi alokasi energi.
- Alasan rekomendasi.
- Estimasi dampak biaya.
- Estimasi dampak emisi.
- Tingkat confidence.
- Action plan.

#### FR-AI-002 AI Insight Naratif

Sistem harus menghasilkan insight naratif menggunakan AI API.

Contoh output:

```text
UMKM Kopi Lestari direkomendasikan sebagai prioritas utama karena memiliki kebutuhan energi tinggi, jumlah pekerja yang signifikan, dan potensi penghematan biaya sebesar 23%. Sumber energi terdekat adalah Solar Hub Kalibaru dengan kapasitas tersedia 1.200 kWh.
```

#### FR-AI-003 Riwayat Rekomendasi

Sistem harus menyimpan riwayat rekomendasi AI.

#### FR-AI-004 Validasi Rekomendasi

Admin atau pemerintah dapat memvalidasi rekomendasi AI.

Status rekomendasi:

- Draft.
- Reviewed.
- Approved.
- Rejected.

#### FR-AI-005 Regenerate Rekomendasi

Admin atau pemerintah dapat melakukan generate ulang rekomendasi jika data berubah.

---

### 5.9 Modul Distribusi Energi

#### FR-DIST-001 Membuat Rencana Distribusi

Admin atau penyedia energi dapat membuat rencana distribusi berdasarkan rekomendasi AI.

Input:

- Sumber energi.
- UMKM tujuan.
- Jumlah energi dialokasikan.
- Tanggal mulai.
- Status distribusi.
- Catatan.

#### FR-DIST-002 Update Status Distribusi

Status distribusi:

- Planned.
- In Progress.
- Completed.
- Cancelled.

#### FR-DIST-003 Melihat Distribusi

UMKM dapat melihat status distribusi untuk usahanya. Pemerintah dan admin dapat melihat seluruh distribusi.

---

### 5.10 Modul Monitoring Dampak

#### FR-IMPACT-001 Menghitung Estimasi Penghematan Biaya

Sistem menghitung penghematan biaya berdasarkan biaya energi lama dan biaya energi baru.

Formula:

```text
cost_saving = old_energy_cost - new_energy_cost
cost_saving_percentage = (cost_saving / old_energy_cost) * 100
```

#### FR-IMPACT-002 Menghitung Estimasi Pengurangan Emisi

Sistem menghitung estimasi pengurangan emisi berdasarkan energi bersih yang digunakan.

Formula sederhana:

```text
emission_reduction = clean_energy_kwh * emission_factor
```

#### FR-IMPACT-003 Menghitung Dampak Produktivitas

Sistem dapat menghitung estimasi peningkatan produktivitas berdasarkan data produksi sebelum dan sesudah distribusi energi.

#### FR-IMPACT-004 Dashboard Dampak

Sistem menampilkan:

- Total UMKM terbantu.
- Total energi bersih tersalurkan.
- Total penghematan biaya.
- Total estimasi pengurangan emisi.
- Total peningkatan produktivitas.

---

### 5.11 Modul Marketplace Produk Lokal

#### FR-PROD-001 Menambah Produk

UMKM dapat menambahkan produk ke marketplace.

Input:

- Nama produk.
- Deskripsi.
- Harga.
- Stok.
- Foto produk.
- Kategori.
- Status clean energy powered.

#### FR-PROD-002 Mengubah Produk

UMKM dapat mengubah produk miliknya.

#### FR-PROD-003 Menghapus Produk

UMKM dapat menghapus produk miliknya.

#### FR-PROD-004 Melihat Produk

Semua pengguna dapat melihat produk yang sudah aktif.

#### FR-PROD-005 Validasi Produk

Admin dapat menyetujui atau menolak produk.

Status produk:

- Pending.
- Active.
- Rejected.
- Archived.

---

### 5.12 Modul Kemitraan

#### FR-PART-001 Mengajukan Kemitraan

Partner, UMKM, provider, atau pemerintah dapat mengajukan kemitraan.

Input:

- Pihak pengirim.
- Pihak penerima.
- Jenis kemitraan.
- Pesan.
- Tujuan kerja sama.
- Lampiran opsional.

Jenis kemitraan:

- Investasi.
- Distribusi energi.
- Pendampingan UMKM.
- Koperasi.
- Pemasaran produk.
- Program pemerintah.

#### FR-PART-002 Mengubah Status Kemitraan

Status:

- Pending.
- Accepted.
- Rejected.
- In Progress.
- Completed.

#### FR-PART-003 Riwayat Kemitraan

Pengguna dapat melihat riwayat kemitraan sesuai hak akses.

---

### 5.13 Modul Laporan

#### FR-REPORT-001 Laporan UMKM

Sistem dapat menghasilkan laporan data UMKM.

#### FR-REPORT-002 Laporan Energi

Sistem dapat menghasilkan laporan sumber energi dan distribusi.

#### FR-REPORT-003 Laporan Dampak

Sistem dapat menghasilkan laporan dampak ekonomi dan lingkungan.

#### FR-REPORT-004 Export PDF

Admin dan pemerintah dapat mengekspor laporan ke PDF.

#### FR-REPORT-005 Export Excel

Admin dapat mengekspor data ke Excel.

---

### 5.14 Modul Dashboard

#### FR-DASH-001 Dashboard Admin

Dashboard admin harus menampilkan:

- Total user.
- Total UMKM.
- Total sumber energi.
- Total rekomendasi AI.
- Total distribusi aktif.
- Total produk marketplace.
- Grafik distribusi energi.
- Grafik dampak.
- Tabel rekomendasi terbaru.

#### FR-DASH-002 Dashboard UMKM

Dashboard UMKM harus menampilkan:

- Profil usaha.
- Kebutuhan energi.
- Status validasi.
- Rekomendasi energi.
- Produk marketplace.
- Pengajuan kemitraan.
- Dampak estimasi.

#### FR-DASH-003 Dashboard Pemerintah

Dashboard pemerintah harus menampilkan:

- Peta wilayah prioritas.
- Statistik UMKM.
- Statistik energi.
- Rekomendasi distribusi.
- Laporan dampak.

#### FR-DASH-004 Dashboard Provider

Dashboard provider harus menampilkan:

- Sumber energi milik provider.
- Kapasitas tersedia.
- Permintaan energi.
- Rencana distribusi.
- Laporan distribusi.

#### FR-DASH-005 Dashboard Partner

Dashboard partner harus menampilkan:

- UMKM potensial.
- Produk lokal.
- Peluang kemitraan.
- Status pengajuan kemitraan.

---

## 6. Kebutuhan Non-Fungsional

### 6.1 Keamanan

| Kode | Kebutuhan |
|---|---|
| NFR-SEC-001 | Sistem harus menggunakan autentikasi token untuk API. |
| NFR-SEC-002 | Password harus di-hash. |
| NFR-SEC-003 | Sistem harus menerapkan role-based access control. |
| NFR-SEC-004 | Input pengguna harus divalidasi di frontend dan backend. |
| NFR-SEC-005 | API harus dilindungi dari akses tidak sah. |
| NFR-SEC-006 | File upload harus membatasi tipe file dan ukuran file. |
| NFR-SEC-007 | Sistem harus menggunakan HTTPS pada production. |
| NFR-SEC-008 | Token API harus dapat dicabut saat logout. |
| NFR-SEC-009 | Error production tidak boleh menampilkan detail stack trace. |
| NFR-SEC-010 | Data sensitif seperti API key harus disimpan di `.env`. |

### 6.2 Performa

| Kode | Kebutuhan |
|---|---|
| NFR-PERF-001 | Landing page harus dapat dimuat kurang dari 3 detik pada koneksi normal. |
| NFR-PERF-002 | API daftar data harus mendukung pagination. |
| NFR-PERF-003 | Query dashboard harus menggunakan eager loading atau agregasi yang efisien. |
| NFR-PERF-004 | Proses AI harus dijalankan melalui queue jika membutuhkan waktu lama. |
| NFR-PERF-005 | Gambar produk harus dikompresi sebelum ditampilkan. |
| NFR-PERF-006 | Frontend harus melakukan lazy loading untuk halaman besar. |

### 6.3 Usability

| Kode | Kebutuhan |
|---|---|
| NFR-USE-001 | UI harus responsif untuk desktop, tablet, dan mobile. |
| NFR-USE-002 | Navigasi dashboard harus mudah dipahami. |
| NFR-USE-003 | Form harus memiliki validasi dan pesan error yang jelas. |
| NFR-USE-004 | Data penting harus divisualisasikan dalam card, chart, dan map. |
| NFR-USE-005 | Warna status harus konsisten. |
| NFR-USE-006 | Sistem harus menyediakan feedback setelah aksi berhasil atau gagal. |

### 6.4 Reliability

| Kode | Kebutuhan |
|---|---|
| NFR-REL-001 | Sistem harus tetap berjalan walaupun AI API gagal, dengan menampilkan fallback rule-based recommendation. |
| NFR-REL-002 | Data penting harus tersimpan secara konsisten. |
| NFR-REL-003 | Sistem harus menyediakan log error. |
| NFR-REL-004 | Queue worker harus dapat dijalankan ulang oleh Supervisor. |

### 6.5 Maintainability

| Kode | Kebutuhan |
|---|---|
| NFR-MAIN-001 | Backend harus menggunakan struktur service class untuk logika bisnis. |
| NFR-MAIN-002 | API harus menggunakan Form Request untuk validasi. |
| NFR-MAIN-003 | API response harus konsisten. |
| NFR-MAIN-004 | Frontend harus dipisahkan per feature/module. |
| NFR-MAIN-005 | Reusable component harus digunakan untuk table, form, modal, chart, dan map. |
| NFR-MAIN-006 | Dokumentasi API harus dibuat menggunakan Scribe atau Swagger. |

### 6.6 Scalability

| Kode | Kebutuhan |
|---|---|
| NFR-SCAL-001 | Sistem harus dapat menambah role baru tanpa mengubah arsitektur utama. |
| NFR-SCAL-002 | Sistem harus dapat menambah jenis energi baru. |
| NFR-SCAL-003 | Sistem harus dapat menambah formula scoring baru. |
| NFR-SCAL-004 | Sistem harus dapat menambah integrasi AI lain. |
| NFR-SCAL-005 | Database harus menggunakan indexing pada kolom yang sering dicari. |

---

## 7. Use Case

### 7.1 Daftar Use Case

| ID | Use Case | Aktor |
|---|---|---|
| UC-001 | Register akun | UMKM, Provider, Government, Partner |
| UC-002 | Login | Semua role |
| UC-003 | Mengelola user | Admin |
| UC-004 | Membuat profil UMKM | UMKM |
| UC-005 | Validasi UMKM | Admin |
| UC-006 | Menambah sumber energi | Provider, Admin |
| UC-007 | Input kebutuhan energi | UMKM |
| UC-008 | Melihat peta energi | Semua role |
| UC-009 | Generate rekomendasi AI | Admin, Government |
| UC-010 | Validasi rekomendasi AI | Admin, Government |
| UC-011 | Membuat rencana distribusi | Admin, Provider |
| UC-012 | Melihat dampak energi | Admin, Government, UMKM |
| UC-013 | Menambah produk marketplace | UMKM |
| UC-014 | Mengajukan kemitraan | Partner, UMKM, Provider |
| UC-015 | Export laporan | Admin, Government |

### 7.2 Use Case Detail

#### UC-001 Register Akun

Aktor:

- UMKM.
- Provider.
- Government.
- Partner.

Precondition:

- Pengguna belum memiliki akun.

Alur utama:

1. Pengguna membuka halaman register.
2. Pengguna memilih role.
3. Pengguna mengisi data akun.
4. Sistem melakukan validasi.
5. Sistem menyimpan akun.
6. Sistem menampilkan pesan berhasil.

Postcondition:

- Akun berhasil dibuat dengan status active atau pending sesuai kebijakan.

#### UC-004 Membuat Profil UMKM

Aktor:

- UMKM.

Precondition:

- User sudah login sebagai UMKM.

Alur utama:

1. UMKM membuka menu profil usaha.
2. UMKM mengisi data usaha.
3. UMKM memilih lokasi pada peta.
4. UMKM mengisi kebutuhan energi awal.
5. UMKM mengunggah foto usaha.
6. Sistem menyimpan data.
7. Status profil menjadi pending.
8. Admin menerima data untuk validasi.

Postcondition:

- Profil UMKM tersimpan.

#### UC-009 Generate Rekomendasi AI

Aktor:

- Admin.
- Government.

Precondition:

- Data UMKM dan sumber energi sudah tersedia.
- Data kebutuhan energi sudah valid.

Alur utama:

1. Aktor membuka halaman AI Recommendation.
2. Aktor memilih wilayah atau periode analisis.
3. Sistem mengambil data UMKM dan sumber energi.
4. Sistem menghitung priority score.
5. Sistem menghitung jarak ke sumber energi terdekat.
6. Sistem mengirim data ringkas ke AI API.
7. AI menghasilkan insight naratif.
8. Sistem menyimpan hasil rekomendasi.
9. Sistem menampilkan rekomendasi di dashboard.

Postcondition:

- Rekomendasi AI tersimpan dan dapat ditinjau.

#### UC-014 Mengajukan Kemitraan

Aktor:

- Partner.
- UMKM.
- Provider.

Precondition:

- User sudah login.

Alur utama:

1. User membuka halaman peluang kemitraan.
2. User memilih target kemitraan.
3. User mengisi pesan dan jenis kemitraan.
4. Sistem menyimpan pengajuan.
5. Penerima mendapatkan notifikasi atau data pengajuan.

Postcondition:

- Pengajuan kemitraan tersimpan dengan status pending.

---

## 8. Rancangan Data

### 8.1 Daftar Entitas Utama

| Entitas | Deskripsi |
|---|---|
| users | Data akun pengguna |
| roles | Data role pengguna |
| businesses | Data UMKM |
| energy_sources | Data sumber energi bersih |
| energy_needs | Data kebutuhan energi UMKM |
| priority_scores | Data hasil perhitungan skor |
| recommendations | Data rekomendasi AI |
| distributions | Data rencana distribusi energi |
| impact_reports | Data monitoring dampak |
| products | Data produk marketplace |
| partnership_requests | Data pengajuan kemitraan |
| regions | Data wilayah |
| files | Data lampiran file |

### 8.2 Struktur Tabel Users

```sql
users
- id BIGINT PRIMARY KEY
- name VARCHAR(150)
- email VARCHAR(150) UNIQUE
- password VARCHAR(255)
- phone VARCHAR(30) NULL
- address TEXT NULL
- status ENUM('active', 'pending', 'suspended')
- email_verified_at TIMESTAMP NULL
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.3 Struktur Tabel Businesses

```sql
businesses
- id BIGINT PRIMARY KEY
- user_id BIGINT FOREIGN KEY
- region_id BIGINT FOREIGN KEY NULL
- name VARCHAR(150)
- sector VARCHAR(100)
- description TEXT
- address TEXT
- latitude DECIMAL(10,8)
- longitude DECIMAL(11,8)
- employee_count INT
- production_capacity DECIMAL(12,2)
- monthly_energy_need DECIMAL(12,2)
- current_energy_cost DECIMAL(15,2)
- clean_energy_access BOOLEAN
- photo VARCHAR(255) NULL
- verification_status ENUM('pending', 'verified', 'rejected')
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.4 Struktur Tabel Energy Sources

```sql
energy_sources
- id BIGINT PRIMARY KEY
- user_id BIGINT FOREIGN KEY
- region_id BIGINT FOREIGN KEY NULL
- name VARCHAR(150)
- type ENUM('solar', 'wind', 'hydro', 'biomass', 'geothermal', 'other')
- description TEXT
- address TEXT
- latitude DECIMAL(10,8)
- longitude DECIMAL(11,8)
- total_capacity_kwh DECIMAL(12,2)
- available_capacity_kwh DECIMAL(12,2)
- status ENUM('active', 'inactive', 'maintenance')
- photo VARCHAR(255) NULL
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.5 Struktur Tabel Energy Needs

```sql
energy_needs
- id BIGINT PRIMARY KEY
- business_id BIGINT FOREIGN KEY
- period VARCHAR(20)
- monthly_need_kwh DECIMAL(12,2)
- operating_hours_per_day INT
- main_equipment TEXT
- current_energy_cost DECIMAL(15,2)
- energy_problem TEXT
- validation_status ENUM('pending', 'validated', 'rejected')
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.6 Struktur Tabel Priority Scores

```sql
priority_scores
- id BIGINT PRIMARY KEY
- business_id BIGINT FOREIGN KEY
- score DECIMAL(5,2)
- category VARCHAR(50)
- energy_need_score DECIMAL(5,2)
- economic_impact_score DECIMAL(5,2)
- worker_score DECIMAL(5,2)
- distance_score DECIMAL(5,2)
- emission_reduction_score DECIMAL(5,2)
- clean_energy_access_score DECIMAL(5,2)
- calculation_notes TEXT
- calculated_at TIMESTAMP
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.7 Struktur Tabel Recommendations

```sql
recommendations
- id BIGINT PRIMARY KEY
- business_id BIGINT FOREIGN KEY
- energy_source_id BIGINT FOREIGN KEY
- priority_score_id BIGINT FOREIGN KEY
- recommended_energy_kwh DECIMAL(12,2)
- distance_km DECIMAL(10,2)
- estimated_cost_saving DECIMAL(15,2)
- estimated_emission_reduction DECIMAL(12,2)
- ai_summary TEXT
- ai_reasoning TEXT
- action_plan TEXT
- confidence_score DECIMAL(5,2)
- status ENUM('draft', 'reviewed', 'approved', 'rejected')
- generated_by BIGINT FOREIGN KEY NULL
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.8 Struktur Tabel Distributions

```sql
distributions
- id BIGINT PRIMARY KEY
- recommendation_id BIGINT FOREIGN KEY
- business_id BIGINT FOREIGN KEY
- energy_source_id BIGINT FOREIGN KEY
- allocated_energy_kwh DECIMAL(12,2)
- start_date DATE
- end_date DATE NULL
- status ENUM('planned', 'in_progress', 'completed', 'cancelled')
- notes TEXT NULL
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.9 Struktur Tabel Impact Reports

```sql
impact_reports
- id BIGINT PRIMARY KEY
- business_id BIGINT FOREIGN KEY
- distribution_id BIGINT FOREIGN KEY NULL
- period VARCHAR(20)
- old_energy_cost DECIMAL(15,2)
- new_energy_cost DECIMAL(15,2)
- cost_saving DECIMAL(15,2)
- cost_saving_percentage DECIMAL(5,2)
- clean_energy_used_kwh DECIMAL(12,2)
- estimated_emission_reduction DECIMAL(12,2)
- productivity_before DECIMAL(12,2) NULL
- productivity_after DECIMAL(12,2) NULL
- productivity_increase_percentage DECIMAL(5,2) NULL
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.10 Struktur Tabel Products

```sql
products
- id BIGINT PRIMARY KEY
- business_id BIGINT FOREIGN KEY
- name VARCHAR(150)
- description TEXT
- category VARCHAR(100)
- price DECIMAL(15,2)
- stock INT
- image VARCHAR(255) NULL
- is_clean_energy_powered BOOLEAN
- status ENUM('pending', 'active', 'rejected', 'archived')
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.11 Struktur Tabel Partnership Requests

```sql
partnership_requests
- id BIGINT PRIMARY KEY
- sender_id BIGINT FOREIGN KEY
- receiver_id BIGINT FOREIGN KEY
- business_id BIGINT FOREIGN KEY NULL
- type VARCHAR(100)
- title VARCHAR(150)
- message TEXT
- attachment VARCHAR(255) NULL
- status ENUM('pending', 'accepted', 'rejected', 'in_progress', 'completed')
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

### 8.12 Struktur Tabel Regions

```sql
regions
- id BIGINT PRIMARY KEY
- name VARCHAR(150)
- province VARCHAR(150)
- city VARCHAR(150)
- district VARCHAR(150) NULL
- latitude DECIMAL(10,8) NULL
- longitude DECIMAL(11,8) NULL
- priority_level ENUM('low', 'medium', 'high') NULL
- created_at TIMESTAMP
- updated_at TIMESTAMP
```

---

## 9. Rancangan API

### 9.1 Format Response Berhasil

```json
{
  "success": true,
  "message": "Data berhasil diambil",
  "data": {}
}
```

### 9.2 Format Response Error

```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {}
}
```

### 9.3 Endpoint Auth

| Method | Endpoint | Deskripsi | Auth |
|---|---|---|---|
| POST | /api/register | Register user | Tidak |
| POST | /api/login | Login user | Tidak |
| POST | /api/logout | Logout user | Ya |
| GET | /api/me | Data user login | Ya |

### 9.4 Endpoint Users

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/users | List user | Admin |
| GET | /api/users/{id} | Detail user | Admin |
| PUT | /api/users/{id} | Update user | Admin |
| DELETE | /api/users/{id} | Delete user | Admin |
| PATCH | /api/users/{id}/status | Update status | Admin |

### 9.5 Endpoint Businesses

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/businesses | List UMKM | Admin, Government, Provider, Partner |
| POST | /api/businesses | Tambah UMKM | UMKM |
| GET | /api/businesses/{id} | Detail UMKM | Sesuai akses |
| PUT | /api/businesses/{id} | Update UMKM | Admin, Owner |
| DELETE | /api/businesses/{id} | Delete UMKM | Admin, Owner terbatas |
| PATCH | /api/businesses/{id}/verify | Validasi UMKM | Admin |

### 9.6 Endpoint Energy Sources

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/energy-sources | List sumber energi | Semua login |
| POST | /api/energy-sources | Tambah sumber energi | Admin, Provider |
| GET | /api/energy-sources/{id} | Detail sumber energi | Semua login |
| PUT | /api/energy-sources/{id} | Update sumber energi | Admin, Owner |
| DELETE | /api/energy-sources/{id} | Delete sumber energi | Admin |
| PATCH | /api/energy-sources/{id}/capacity | Update kapasitas | Admin, Provider |

### 9.7 Endpoint Energy Needs

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/energy-needs | List kebutuhan energi | Admin, Government |
| POST | /api/energy-needs | Tambah kebutuhan energi | UMKM |
| GET | /api/energy-needs/{id} | Detail kebutuhan energi | Sesuai akses |
| PUT | /api/energy-needs/{id} | Update kebutuhan energi | UMKM owner |
| PATCH | /api/energy-needs/{id}/validate | Validasi kebutuhan | Admin |

### 9.8 Endpoint Map

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/map/markers | Marker UMKM dan energi | Semua login |
| GET | /api/map/priority-areas | Wilayah prioritas | Admin, Government |
| GET | /api/map/distributions | Jalur distribusi | Admin, Government, Provider |

### 9.9 Endpoint Recommendations

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/recommendations | List rekomendasi | Sesuai akses |
| POST | /api/recommendations/generate | Generate rekomendasi AI | Admin, Government |
| GET | /api/recommendations/{id} | Detail rekomendasi | Sesuai akses |
| PATCH | /api/recommendations/{id}/status | Update status | Admin, Government |
| POST | /api/recommendations/{id}/regenerate | Regenerate rekomendasi | Admin, Government |

### 9.10 Endpoint Distributions

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/distributions | List distribusi | Sesuai akses |
| POST | /api/distributions | Buat distribusi | Admin, Provider |
| GET | /api/distributions/{id} | Detail distribusi | Sesuai akses |
| PUT | /api/distributions/{id} | Update distribusi | Admin, Provider |
| PATCH | /api/distributions/{id}/status | Update status | Admin, Provider |

### 9.11 Endpoint Products

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/products | List produk | Public/Login |
| POST | /api/products | Tambah produk | UMKM |
| GET | /api/products/{id} | Detail produk | Public/Login |
| PUT | /api/products/{id} | Update produk | Owner |
| DELETE | /api/products/{id} | Delete produk | Owner/Admin |
| PATCH | /api/products/{id}/status | Validasi produk | Admin |

### 9.12 Endpoint Partnerships

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/partnerships | List kemitraan | Sesuai akses |
| POST | /api/partnerships | Ajukan kemitraan | Semua login |
| GET | /api/partnerships/{id} | Detail kemitraan | Sesuai akses |
| PATCH | /api/partnerships/{id}/status | Update status | Penerima/Admin |

### 9.13 Endpoint Reports

| Method | Endpoint | Deskripsi | Role |
|---|---|---|---|
| GET | /api/reports/impact | Laporan dampak | Admin, Government |
| GET | /api/reports/energy | Laporan energi | Admin, Government, Provider |
| GET | /api/reports/businesses | Laporan UMKM | Admin, Government |
| GET | /api/reports/export/pdf | Export PDF | Admin, Government |
| GET | /api/reports/export/excel | Export Excel | Admin |

---

## 10. Rancangan UI/UX

### 10.1 Style UI

Style yang digunakan:

```text
AI Climate-Tech SaaS
```

Karakter visual:

- Modern.
- Clean.
- Futuristik.
- Berbasis dashboard.
- Warna dominan emerald, teal, cyan, slate.
- Card dengan rounded corner besar.
- Visualisasi data menggunakan chart dan peta.
- Landing page bergaya Linear/Vercel dengan nuansa sustainability.

### 10.2 Design System

#### Warna

| Token | Warna |
|---|---|
| Primary | Emerald |
| Secondary | Teal |
| Accent | Cyan atau Lime |
| Background Dark | Slate/Navy |
| Background Light | White/Slate-50 |
| Success | Green |
| Warning | Amber |
| Error | Red |
| Info | Blue |

#### Typography

- Font utama: Inter.
- Heading: font-bold, tracking-tight.
- Body: text-base, leading-relaxed.
- Caption: text-sm.

#### Komponen UI

Komponen utama:

- Button.
- Card.
- Badge.
- Input.
- Select.
- Textarea.
- Modal.
- Sheet.
- Table.
- Tabs.
- Dropdown.
- Toast.
- Sidebar.
- Breadcrumb.
- Chart card.
- Map card.

### 10.3 Halaman Public

#### Landing Page

Section:

1. Navbar.
2. Hero section.
3. Statistic preview.
4. Problem section.
5. Solution section.
6. AI recommendation preview.
7. Energy map preview.
8. Marketplace preview.
9. Role benefit section.
10. Impact section.
11. CTA.
12. Footer.

#### Marketplace Public

Fitur:

- List produk.
- Search produk.
- Filter kategori.
- Detail produk.
- Label clean energy powered.

### 10.4 Halaman Auth

Halaman:

- Login.
- Register.
- Forgot password.
- Reset password.

### 10.5 Admin Dashboard

Menu:

- Overview.
- Users.
- UMKM.
- Energy Sources.
- Energy Needs.
- Recommendations.
- Distributions.
- Products.
- Partnerships.
- Reports.
- Settings.

### 10.6 UMKM Dashboard

Menu:

- Overview.
- Business Profile.
- Energy Needs.
- Recommendations.
- Products.
- Partnerships.
- Impact.

### 10.7 Government Dashboard

Menu:

- Overview.
- Priority Map.
- Businesses.
- Energy Sources.
- Recommendations.
- Impact Reports.

### 10.8 Provider Dashboard

Menu:

- Overview.
- Energy Sources.
- Distribution Requests.
- Distributions.
- Impact.

### 10.9 Partner Dashboard

Menu:

- Overview.
- Opportunities.
- Businesses.
- Marketplace.
- Partnership Requests.

---

## 11. AI Requirement

### 11.1 Tujuan AI

AI digunakan untuk:

1. Membantu memprioritaskan UMKM atau wilayah.
2. Memberikan rekomendasi distribusi energi.
3. Menghasilkan insight naratif.
4. Menjelaskan alasan rekomendasi.
5. Membantu pengambilan keputusan berbasis data.

### 11.2 Input AI

Data input:

- Data UMKM.
- Lokasi UMKM.
- Kebutuhan energi.
- Biaya energi saat ini.
- Jumlah pekerja.
- Kapasitas produksi.
- Data sumber energi.
- Kapasitas energi tersedia.
- Jarak UMKM ke sumber energi.
- Priority score.
- Estimasi penghematan biaya.
- Estimasi pengurangan emisi.

### 11.3 Output AI

Output:

- Rekomendasi sumber energi.
- UMKM atau wilayah prioritas.
- Alasan rekomendasi.
- Dampak ekonomi.
- Dampak lingkungan.
- Action plan.
- Confidence score.

### 11.4 Fallback AI

Jika AI API gagal:

1. Sistem tetap menghitung skor prioritas.
2. Sistem menampilkan rekomendasi rule-based.
3. Sistem memberi label bahwa insight AI belum tersedia.
4. Admin dapat melakukan generate ulang.

### 11.5 Prompt Template

Contoh prompt:

```text
Anda adalah analis distribusi energi bersih dan ekonomi lokal.
Berdasarkan data berikut, buat rekomendasi distribusi energi yang adil, efisien, dan berdampak.

Data UMKM:
{business_data}

Data sumber energi:
{energy_source_data}

Priority score:
{priority_score}

Estimasi dampak:
{impact_data}

Berikan output:
1. Rekomendasi utama.
2. Alasan prioritas.
3. Dampak ekonomi.
4. Dampak lingkungan.
5. Action plan.
6. Risiko dan catatan.
```

---

## 12. Rancangan Scoring dan Perhitungan

### 12.1 Distance Calculation

Sistem menghitung jarak menggunakan rumus Haversine.

Input:

- Latitude UMKM.
- Longitude UMKM.
- Latitude sumber energi.
- Longitude sumber energi.

Output:

- Jarak dalam kilometer.

### 12.2 Energy Need Score

| Kebutuhan Energi | Skor |
|---|---|
| > 1000 kWh | 100 |
| 700 - 1000 kWh | 80 |
| 400 - 699 kWh | 60 |
| 100 - 399 kWh | 40 |
| < 100 kWh | 20 |

### 12.3 Distance Score

| Jarak | Skor |
|---|---|
| 0 - 5 km | 100 |
| 6 - 10 km | 80 |
| 11 - 20 km | 60 |
| 21 - 40 km | 40 |
| > 40 km | 20 |

### 12.4 Clean Energy Access Score

| Kondisi | Skor |
|---|---|
| Belum punya akses energi bersih | 100 |
| Akses terbatas | 70 |
| Sudah punya akses cukup | 30 |

### 12.5 Final Priority Score

Formula awal:

```text
priority_score =
(energy_need_score * 0.25) +
(economic_impact_score * 0.20) +
(worker_score * 0.15) +
(distance_score * 0.15) +
(emission_reduction_score * 0.15) +
(clean_energy_access_score * 0.10)
```

Formula dapat disesuaikan berdasarkan kebutuhan demo.

---

## 13. Struktur Project

### 13.1 Struktur Backend Laravel

```text
Enerco_be/
├── app/
│   ├── Enums/
│   ├── Http/
│   │   ├── Controllers/Api/
│   │   ├── Requests/
│   │   └── Resources/
│   ├── Jobs/
│   ├── Models/
│   ├── Policies/
│   └── Services/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── routes/
│   ├── api.php
│   └── web.php
├── storage/
└── tests/
```

### 13.2 Struktur Frontend React

```text
Enerco_fe/
├── public/
├── src/
│   ├── app/
│   ├── assets/
│   ├── components/
│   │   ├── ui/
│   │   ├── charts/
│   │   ├── maps/
│   │   ├── forms/
│   │   └── tables/
│   ├── features/
│   │   ├── auth/
│   │   ├── businesses/
│   │   ├── energy-sources/
│   │   ├── recommendations/
│   │   ├── distributions/
│   │   ├── products/
│   │   └── partnerships/
│   ├── hooks/
│   ├── layouts/
│   ├── lib/
│   ├── pages/
│   │   ├── public/
│   │   ├── auth/
│   │   ├── admin/
│   │   ├── umkm/
│   │   ├── government/
│   │   ├── provider/
│   │   └── partner/
│   ├── routes/
│   ├── services/
│   └── types/
└── package.json
```

---

## 14. Deployment Requirement

### 14.1 Backend Deployment

Backend Laravel ditempatkan pada VPS.

Kebutuhan VPS:

- Ubuntu 22.04/24.04.
- Nginx.
- PHP 8.3+.
- Composer.
- MySQL 8.
- Redis.
- Supervisor.
- SSL Certbot.

Contoh domain:

```text
https://api.energeco.com
```

### 14.2 Frontend Deployment

Frontend React ditempatkan pada Vercel.

Contoh domain:

```text
https://energeco.com
```

### 14.3 Environment Backend

Contoh `.env` backend:

```env
APP_NAME="EnergEco GlobalChain"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://api.energeco.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=energeco
DB_USERNAME=energeco_user
DB_PASSWORD=secret

CACHE_STORE=redis
QUEUE_CONNECTION=redis

AI_PROVIDER=gemini
AI_API_KEY=your_api_key
FRONTEND_URL=https://energeco.com
```

### 14.4 Environment Frontend

Contoh `.env` frontend:

```env
VITE_API_URL=https://api.energeco.com/api
VITE_APP_NAME=EnergEco GlobalChain
```

---

## 15. Testing Requirement

### 15.1 Backend Testing

Jenis pengujian:

- Unit test untuk service scoring.
- Feature test untuk auth.
- Feature test untuk CRUD UMKM.
- Feature test untuk energy source.
- Feature test untuk recommendation generate.
- Policy test untuk role permission.
- API validation test.

### 15.2 Frontend Testing

Jenis pengujian:

- Component test.
- Form validation test.
- Route protection test.
- API integration test.
- Responsive layout test.

### 15.3 Manual Testing

Checklist manual:

- Register user.
- Login user.
- Role redirect.
- CRUD UMKM.
- CRUD sumber energi.
- Input kebutuhan energi.
- Generate rekomendasi AI.
- Lihat peta.
- Tambah produk.
- Ajukan kemitraan.
- Export laporan.
- Logout.

---

## 16. Acceptance Criteria

### 16.1 MVP dianggap selesai jika:

1. User dapat register dan login.
2. Role-based dashboard berjalan.
3. Admin dapat mengelola data utama.
4. UMKM dapat membuat profil usaha.
5. Provider dapat menambah sumber energi.
6. Sistem dapat menampilkan peta UMKM dan sumber energi.
7. Sistem dapat menghitung priority score.
8. Sistem dapat menghasilkan rekomendasi AI.
9. Sistem dapat menampilkan dashboard dampak.
10. UMKM dapat menambahkan produk marketplace.
11. Partner dapat mengajukan kemitraan.
12. Sistem dapat berjalan pada deployment demo.
13. UI responsif pada desktop dan mobile.
14. API terdokumentasi.
15. Demo dapat dipresentasikan dengan alur yang jelas.

### 16.2 Kriteria Demo Hackathon

Demo berhasil jika juri dapat melihat:

1. Masalah yang diselesaikan jelas.
2. Alur pengguna mudah dipahami.
3. Data energi dan UMKM tampil di peta.
4. AI menghasilkan rekomendasi yang masuk akal.
5. Dashboard menunjukkan dampak ekonomi dan lingkungan.
6. Sistem memiliki role yang jelas.
7. UI terlihat profesional.
8. Backend dan frontend berjalan stabil.
9. Sistem dapat diakses secara online.
10. Ide memiliki rencana keberlanjutan.

---

## 17. Risiko dan Mitigasi

| Risiko | Dampak | Mitigasi |
|---|---|---|
| AI API gagal | Rekomendasi naratif tidak muncul | Gunakan fallback rule-based |
| Data demo kurang realistis | Demo kurang meyakinkan | Buat seed data yang rapi |
| Frontend terlalu kompleks | Waktu pengerjaan lama | Prioritaskan MVP |
| Backend API belum stabil | Integrasi terganggu | Gunakan Postman dan testing |
| Deployment gagal | Demo tidak bisa online | Siapkan local demo dan backup VPS |
| Peta lambat | UX buruk | Batasi jumlah marker dan gunakan clustering |
| Role permission salah | Data bocor | Gunakan policy dan middleware |
| UI tidak konsisten | Kualitas demo turun | Gunakan design system sejak awal |

---

## 18. Prioritas Pengembangan

### 18.1 Prioritas 1 - Core MVP

1. Auth dan role.
2. CRUD UMKM.
3. CRUD sumber energi.
4. Peta lokasi.
5. Priority scoring.
6. AI recommendation.
7. Dashboard utama.

### 18.2 Prioritas 2 - Demo Enhancement

1. Marketplace.
2. Kemitraan.
3. Impact report.
4. Export laporan.
5. Chart dashboard.

### 18.3 Prioritas 3 - Advanced Feature

1. Realtime notification.
2. AI chatbot.
3. Advanced geospatial analysis.
4. Forecasting kebutuhan energi.
5. Integrasi open data cuaca.

---

## 19. Roadmap Pengembangan

### Fase 1 - Analisis dan Desain

Output:

- SRS.
- ERD.
- Wireframe.
- API contract.
- Design system.

### Fase 2 - Setup Project

Output:

- Laravel 13 backend.
- React frontend.
- MySQL database.
- Auth basic.
- Repository GitHub.

### Fase 3 - Core Backend

Output:

- Migration.
- Model.
- Seeder.
- API CRUD.
- Role permission.
- Service scoring.

### Fase 4 - Core Frontend

Output:

- Landing page.
- Auth page.
- Dashboard layout.
- Table.
- Form.
- Protected route.

### Fase 5 - Map dan AI

Output:

- Map UMKM dan energi.
- Priority score.
- AI recommendation.
- Recommendation dashboard.

### Fase 6 - Marketplace dan Kemitraan

Output:

- Produk UMKM.
- Pengajuan kemitraan.
- Partner dashboard.

### Fase 7 - Report dan Deployment

Output:

- Report dashboard.
- Export PDF.
- Deploy backend.
- Deploy frontend.
- Final demo script.

---

## 20. Lampiran

### 20.1 Contoh Data Demo UMKM

| Nama UMKM | Sektor | Kebutuhan Energi | Pekerja | Lokasi |
|---|---|---:|---:|---|
| Kopi Lestari | Agroindustri | 420 kWh | 12 | Banyuwangi |
| Batik Surya | Kerajinan | 280 kWh | 8 | Malang |
| Tahu Mandiri | Pangan | 750 kWh | 20 | Kediri |
| Ikan Asap Bahari | Perikanan | 610 kWh | 15 | Probolinggo |

### 20.2 Contoh Data Demo Sumber Energi

| Nama | Jenis | Kapasitas | Lokasi |
|---|---|---:|---|
| Solar Hub Kalibaru | Solar | 1200 kWh | Banyuwangi |
| Micro Hydro Brantas | Hydro | 2000 kWh | Malang |
| Biomass Agro Plant | Biomass | 1500 kWh | Kediri |

### 20.3 Contoh Output Rekomendasi

```text
UMKM Tahu Mandiri direkomendasikan sebagai prioritas distribusi energi bersih karena memiliki kebutuhan energi tinggi sebesar 750 kWh/bulan, jumlah pekerja sebanyak 20 orang, dan potensi penghematan biaya energi sebesar 24%. Sumber energi yang paling sesuai adalah Biomass Agro Plant karena jaraknya relatif dekat dan memiliki kapasitas tersedia yang cukup.
```

---

## 21. Penutup

Dokumen SRS ini menjadi dasar pengembangan sistem EnergEco GlobalChain. Seluruh kebutuhan fungsional, non-fungsional, rancangan data, API, UI/UX, AI, deployment, dan acceptance criteria yang dijelaskan dalam dokumen ini dapat dijadikan acuan oleh tim pengembang agar proses pembuatan sistem lebih terarah, terukur, dan siap dipresentasikan sebagai demo hackathon.
