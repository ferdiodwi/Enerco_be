# PLANNING PEMBUATAN SISTEM
# EnergEco GlobalChain
# Sistem Informasi Web Berbasis AI untuk Distribusi Energi Bersih dan Transformasi Ekonomi Lokal Berkelanjutan

Versi Dokumen : 1.0
Kategori      : Hackathon Web Application
Tech Stack    : Laravel + MySQL + React

============================================================
1. RINGKASAN PROYEK
============================================================

EnergEco GlobalChain adalah sistem informasi web berbasis AI yang digunakan untuk membantu pemetaan, pemantauan, dan optimasi distribusi energi bersih kepada pelaku ekonomi lokal seperti UMKM, koperasi, komunitas desa, penyedia energi, pemerintah daerah, dan mitra strategis.

Sistem ini dirancang untuk menjawab kebutuhan energi bersih dan mendukung swasembada ekonomi lokal melalui fitur utama berupa dashboard energi, peta potensi energi dan UMKM, sistem rekomendasi AI, prioritas bantuan energi, monitoring dampak, serta marketplace/kemitraan lokal.

Tujuan utama sistem:
1. Membantu pemerintah daerah dan penyedia energi menentukan prioritas distribusi energi bersih.
2. Membantu UMKM memperoleh akses energi bersih yang lebih efisien dan terjangkau.
3. Mengukur dampak penggunaan energi bersih terhadap biaya, produktivitas, dan pengurangan emisi.
4. Menghubungkan UMKM, penyedia energi, pemerintah, koperasi, dan investor dalam satu ekosistem digital.
5. Mendukung SDG 1, SDG 7, SDG 9, dan SDG 17.

============================================================
2. TARGET PENGGUNA SISTEM
============================================================

2.1 Admin
- Mengelola seluruh data pengguna.
- Mengelola data UMKM.
- Mengelola data sumber energi bersih.
- Mengelola data distribusi energi.
- Mengelola rekomendasi AI.
- Melihat laporan dampak dan statistik sistem.

2.2 Pemerintah Daerah
- Melihat peta wilayah prioritas energi.
- Melihat daftar UMKM/sektor yang membutuhkan bantuan energi.
- Melihat rekomendasi distribusi energi.
- Melihat dampak sosial dan ekonomi dari program energi bersih.

2.3 Penyedia Energi
- Mendaftarkan sumber energi bersih.
- Melihat kebutuhan energi UMKM di sekitar lokasi.
- Melihat rekomendasi distribusi.
- Menerima pengajuan kerja sama.

2.4 UMKM
- Mendaftarkan profil usaha.
- Menginput kebutuhan energi.
- Melihat rekomendasi bantuan energi.
- Menampilkan produk pada marketplace lokal.
- Mengajukan kemitraan dengan penyedia energi atau investor.

2.5 Investor/Mitra/Koperasi
- Melihat UMKM potensial.
- Melihat sektor ekonomi lokal yang memiliki dampak tinggi.
- Mengajukan kemitraan atau dukungan.

============================================================
3. TECH STACK SISTEM
============================================================

3.1 Backend
Framework utama:
- Laravel 12/13

Library/Package pendukung:
- Laravel Sanctum untuk autentikasi API.
- Laravel Filament untuk admin panel.
- Laravel Queue untuk pemrosesan rekomendasi AI.
- Laravel Scheduler untuk proses otomatis berkala.
- Laravel HTTP Client untuk integrasi AI API.
- Laravel Policy/Gate untuk pembatasan akses role.
- Laravel Storage untuk manajemen file/gambar.

3.2 Database
Database utama:
- MySQL

Alasan penggunaan MySQL:
- Mudah digunakan dan umum dipakai dengan Laravel.
- Cocok untuk sistem CRUD, dashboard, rekomendasi, dan laporan.
- Mudah dideploy pada shared hosting maupun VPS.
- Cukup untuk kebutuhan MVP hackathon.

3.3 Frontend
Framework utama:
- React + Vite

Library pendukung:
- Tailwind CSS untuk styling.
- React Router untuk routing halaman.
- Axios untuk komunikasi API.
- Recharts untuk grafik dashboard.
- Leaflet untuk peta lokasi UMKM dan sumber energi.
- SweetAlert/Toast untuk notifikasi.

3.4 AI
Opsi AI:
- Gemini API atau OpenAI API untuk rekomendasi naratif.
- Rule-based scoring di Laravel untuk skor prioritas.

Pendekatan AI:
- Hybrid AI: kombinasi perhitungan skor berbasis aturan dan AI generatif untuk menghasilkan insight.

3.5 Deployment
Opsi deployment:
- VPS dengan Nginx, PHP, MySQL, Node.js.
- Docker untuk deployment lebih rapi.
- Shared hosting jika ingin versi sederhana.

============================================================
4. ARSITEKTUR SISTEM
============================================================

Alur utama sistem:

React Frontend
    |
    | REST API menggunakan Axios
    v
Laravel Backend API
    |
    | Query data
    v
MySQL Database
    |
    | Data UMKM, energi, distribusi, skor, laporan
    v
AI Recommendation Engine
    |
    | Scoring + AI insight
    v
Rekomendasi Distribusi Energi

Penjelasan:
1. Pengguna mengakses frontend React.
2. React mengambil data dari backend Laravel melalui REST API.
3. Laravel menyimpan dan mengambil data dari MySQL.
4. Laravel menghitung skor prioritas berdasarkan data UMKM dan sumber energi.
5. Laravel dapat memanggil API AI untuk menghasilkan rekomendasi naratif.
6. Hasil rekomendasi disimpan ke database dan ditampilkan pada dashboard.

============================================================
5. FITUR UTAMA SISTEM
============================================================

5.1 Authentication & Authorization
Fitur:
- Register.
- Login.
- Logout.
- Token API menggunakan Laravel Sanctum.
- Role user: Admin, Pemerintah, Penyedia Energi, UMKM, Investor.
- Pembatasan akses berdasarkan role.

Prioritas: Wajib

5.2 Dashboard Energi Bersih
Fitur:
- Total sumber energi bersih.
- Total kapasitas energi tersedia.
- Total kebutuhan energi UMKM.
- Total wilayah/UMKM penerima manfaat.
- Grafik distribusi energi per sektor.
- Grafik status sumber energi.
- Ringkasan dampak penghematan biaya dan emisi.

Prioritas: Wajib

5.3 Manajemen Sumber Energi
Fitur:
- Tambah sumber energi.
- Edit sumber energi.
- Hapus sumber energi.
- Detail sumber energi.
- Status sumber energi: aktif, penuh, maintenance, nonaktif.
- Data kapasitas dan ketersediaan energi.
- Titik lokasi latitude dan longitude.

Jenis energi:
- Surya.
- Angin.
- Mikrohidro.
- Biomassa.
- Hybrid.

Prioritas: Wajib

5.4 Manajemen UMKM
Fitur:
- Tambah data UMKM.
- Edit data UMKM.
- Hapus data UMKM.
- Detail UMKM.
- Input sektor usaha.
- Input kebutuhan energi bulanan.
- Input biaya energi saat ini.
- Input jumlah pekerja.
- Input kapasitas produksi.
- Input lokasi latitude dan longitude.

Prioritas: Wajib

5.5 Peta Potensi Energi dan UMKM
Fitur:
- Menampilkan titik lokasi sumber energi bersih.
- Menampilkan titik lokasi UMKM.
- Warna marker berdasarkan jenis energi atau skor prioritas.
- Popup detail lokasi.
- Filter berdasarkan sektor, wilayah, jenis energi, status.

Tools:
- React Leaflet.
- Latitude dan longitude disimpan di MySQL.

Prioritas: Wajib

5.6 AI Recommendation Engine
Fitur:
- Menghitung skor prioritas UMKM.
- Menghitung rekomendasi sumber energi terdekat.
- Memberikan rekomendasi wilayah/sektor prioritas.
- Memberikan alasan rekomendasi.
- Menyimpan hasil rekomendasi ke database.

Parameter AI/scoring:
- Kebutuhan energi.
- Biaya energi saat ini.
- Jumlah pekerja.
- Kapasitas produksi.
- Sektor usaha.
- Jarak ke sumber energi.
- Ketersediaan kapasitas energi.
- Potensi pengurangan emisi.
- Dampak ekonomi lokal.

Prioritas: Wajib

5.7 Prioritas Bantuan Energi
Fitur:
- Ranking UMKM berdasarkan skor prioritas.
- Filter ranking berdasarkan wilayah dan sektor.
- Detail alasan prioritas.
- Status bantuan: diajukan, direkomendasikan, disetujui, berjalan, selesai.

Prioritas: Wajib

5.8 Monitoring Dampak
Fitur:
- Estimasi penghematan biaya energi.
- Estimasi peningkatan produktivitas.
- Estimasi pengurangan emisi karbon.
- Laporan dampak per UMKM.
- Laporan dampak per wilayah.
- Grafik perkembangan dampak.

Prioritas: Wajib

5.9 Marketplace/Kemitraan Lokal
Fitur:
- UMKM dapat menampilkan produk lokal.
- Mitra dapat melihat produk UMKM.
- Pengajuan kemitraan antara UMKM, penyedia energi, pemerintah, koperasi, atau investor.
- Status pengajuan kerja sama.

Prioritas: Tambahan

5.10 Export Laporan
Fitur:
- Export laporan rekomendasi energi dalam PDF.
- Export laporan dampak dalam PDF.
- Export data UMKM dalam Excel/CSV.

Prioritas: Tambahan

============================================================
6. RANCANGAN DATABASE MYSQL
============================================================

6.1 Tabel users
Kolom:
- id
- name
- email
- password
- role
- phone
- status
- created_at
- updated_at

Role:
- admin
- government
- energy_provider
- business_owner
- investor

6.2 Tabel businesses
Kolom:
- id
- user_id
- name
- sector
- description
- address
- city
- province
- latitude
- longitude
- monthly_energy_need
- current_energy_cost
- production_capacity
- employee_count
- clean_energy_access
- status
- created_at
- updated_at

6.3 Tabel energy_sources
Kolom:
- id
- provider_id
- name
- type
- description
- address
- city
- province
- latitude
- longitude
- capacity_kwh
- available_kwh
- cost_per_kwh
- status
- created_at
- updated_at

6.4 Tabel priority_scores
Kolom:
- id
- business_id
- energy_need_score
- economic_impact_score
- distance_score
- sustainability_score
- emission_reduction_score
- total_score
- priority_level
- calculated_at
- created_at
- updated_at

Priority level:
- low
- medium
- high
- urgent

6.5 Tabel distribution_recommendations
Kolom:
- id
- business_id
- energy_source_id
- priority_score_id
- recommended_energy_kwh
- distance_km
- recommendation_reason
- ai_summary
- status
- created_at
- updated_at

Status:
- draft
- recommended
- approved
- rejected
- implemented

6.6 Tabel impact_reports
Kolom:
- id
- business_id
- distribution_recommendation_id
- old_energy_cost
- new_energy_cost
- cost_saving
- productivity_increase_percentage
- estimated_emission_reduction
- report_period
- notes
- created_at
- updated_at

6.7 Tabel products
Kolom:
- id
- business_id
- name
- description
- price
- image
- status
- created_at
- updated_at

6.8 Tabel partnership_requests
Kolom:
- id
- sender_id
- receiver_id
- business_id
- type
- message
- status
- created_at
- updated_at

Type:
- funding
- energy_support
- distribution
- product_collaboration
- government_program

Status:
- pending
- accepted
- rejected
- completed

6.9 Tabel activity_logs
Kolom:
- id
- user_id
- action
- description
- created_at
- updated_at

============================================================
7. RANCANGAN API ENDPOINT
============================================================

7.1 Auth API
POST   /api/register
POST   /api/login
POST   /api/logout
GET    /api/user

7.2 Dashboard API
GET    /api/dashboard/summary
GET    /api/dashboard/energy-chart
GET    /api/dashboard/impact-chart
GET    /api/dashboard/priority-map

7.3 Business API
GET    /api/businesses
POST   /api/businesses
GET    /api/businesses/{id}
PUT    /api/businesses/{id}
DELETE /api/businesses/{id}

7.4 Energy Source API
GET    /api/energy-sources
POST   /api/energy-sources
GET    /api/energy-sources/{id}
PUT    /api/energy-sources/{id}
DELETE /api/energy-sources/{id}

7.5 Recommendation API
POST   /api/recommendations/generate
GET    /api/recommendations
GET    /api/recommendations/{id}
PUT    /api/recommendations/{id}/status

7.6 Priority Score API
POST   /api/priority-scores/calculate
GET    /api/priority-scores
GET    /api/priority-scores/{id}

7.7 Impact Report API
GET    /api/impact-reports
POST   /api/impact-reports
GET    /api/impact-reports/{id}

7.8 Marketplace API
GET    /api/products
POST   /api/products
GET    /api/products/{id}
PUT    /api/products/{id}
DELETE /api/products/{id}

7.9 Partnership API
GET    /api/partnership-requests
POST   /api/partnership-requests
PUT    /api/partnership-requests/{id}/status

============================================================
8. ALGORITMA AI DAN SCORING
============================================================

8.1 Formula Skor Prioritas

Total Priority Score =
(energy_need_score * 0.30) +
(economic_impact_score * 0.25) +
(distance_score * 0.15) +
(sustainability_score * 0.15) +
(emission_reduction_score * 0.15)

8.2 Penjelasan Parameter

energy_need_score:
- Semakin besar kebutuhan energi UMKM, semakin tinggi skor.

conomic_impact_score:
- Dinilai dari jumlah pekerja, kapasitas produksi, dan sektor usaha.

Distance_score:
- Semakin dekat UMKM dengan sumber energi, semakin tinggi skor distribusi.

sustainability_score:
- Dinilai dari potensi usaha mendukung ekonomi lokal berkelanjutan.

emission_reduction_score:
- Estimasi penurunan emisi setelah berpindah ke energi bersih.

8.3 Level Prioritas

0 - 40   : Low
41 - 60  : Medium
61 - 80  : High
81 - 100 : Urgent

8.4 Alur Generate Rekomendasi

1. Admin atau pemerintah menekan tombol Generate Recommendation.
2. Laravel mengambil data UMKM dari database.
3. Laravel mengambil data sumber energi yang aktif dan tersedia.
4. Laravel menghitung jarak UMKM ke sumber energi.
5. Laravel menghitung skor prioritas.
6. Laravel memilih sumber energi yang paling sesuai.
7. Laravel mengirim data ringkas ke AI API.
8. AI menghasilkan alasan rekomendasi berbentuk narasi.
9. Laravel menyimpan hasil rekomendasi ke database.
10. Dashboard menampilkan hasil rekomendasi.

8.5 Contoh Output AI

UMKM A direkomendasikan menjadi prioritas distribusi energi bersih karena memiliki kebutuhan energi tinggi, biaya operasional energi yang besar, jumlah pekerja cukup banyak, serta lokasi yang dekat dengan sumber energi surya terdekat. Distribusi energi bersih diperkirakan dapat menurunkan biaya energi sebesar 25% dan meningkatkan kapasitas produksi sebesar 15%.

============================================================
9. RANCANGAN HALAMAN FRONTEND REACT
============================================================

9.1 Public Page
Halaman:
- Landing Page
- About EnergEco
- Marketplace Produk UMKM
- Login
- Register

9.2 Dashboard Admin
Halaman:
- Dashboard utama
- Data user
- Data UMKM
- Data sumber energi
- Data rekomendasi AI
- Data laporan dampak
- Data kemitraan

9.3 Dashboard Pemerintah
Halaman:
- Ringkasan wilayah prioritas
- Peta distribusi energi
- Daftar rekomendasi AI
- Laporan dampak ekonomi dan emisi

9.4 Dashboard Penyedia Energi
Halaman:
- Data sumber energi milik penyedia
- Daftar UMKM potensial terdekat
- Rekomendasi distribusi
- Permintaan kerja sama

9.5 Dashboard UMKM
Halaman:
- Profil UMKM
- Input kebutuhan energi
- Status rekomendasi bantuan energi
- Produk marketplace
- Pengajuan kemitraan

9.6 Dashboard Investor/Mitra
Halaman:
- Daftar UMKM potensial
- Detail dampak ekonomi
- Form pengajuan kemitraan

============================================================
10. FLOW PENGGUNA
============================================================

10.1 Flow UMKM
1. UMKM melakukan register.
2. UMKM login ke sistem.
3. UMKM mengisi profil usaha.
4. UMKM mengisi kebutuhan energi.
5. Sistem menghitung skor prioritas.
6. UMKM melihat status rekomendasi.
7. UMKM dapat menambahkan produk ke marketplace.
8. UMKM dapat menerima pengajuan kemitraan.

10.2 Flow Pemerintah
1. Pemerintah login.
2. Pemerintah melihat dashboard wilayah.
3. Pemerintah melihat peta UMKM dan sumber energi.
4. Pemerintah menekan generate recommendation.
5. Sistem menampilkan ranking prioritas.
6. Pemerintah menyetujui rekomendasi distribusi.
7. Pemerintah melihat laporan dampak.

10.3 Flow Penyedia Energi
1. Penyedia energi login.
2. Penyedia energi menambahkan sumber energi.
3. Sistem menampilkan UMKM terdekat.
4. Penyedia energi melihat rekomendasi distribusi.
5. Penyedia energi menerima atau mengajukan kemitraan.

10.4 Flow Admin
1. Admin login.
2. Admin memverifikasi data user.
3. Admin mengelola data master.
4. Admin memantau rekomendasi AI.
5. Admin mengekspor laporan.

============================================================
11. PEMBAGIAN TUGAS TIM
============================================================

Anggota 1 - Backend Developer
Tugas:
- Setup Laravel.
- Membuat database migration.
- Membuat model dan relasi.
- Membuat API endpoint.
- Membuat authentication dengan Sanctum.
- Membuat scoring dan recommendation service.
- Integrasi AI API.

Anggota 2 - Frontend Developer
Tugas:
- Setup React Vite.
- Membuat layout dashboard.
- Membuat halaman login/register.
- Membuat halaman dashboard.
- Integrasi API dengan Axios.
- Membuat peta dengan Leaflet.
- Membuat grafik dengan Recharts.

Anggota 3 - UI/UX, Data, dan Presenter
Tugas:
- Membuat desain UI/UX.
- Menyiapkan data dummy UMKM dan energi.
- Menyusun narasi presentasi.
- Membuat slide pitch deck.
- Menyiapkan demo flow.
- Membantu testing fitur.

============================================================
12. TIMELINE PENGEMBANGAN MVP
============================================================

Tahap 1 - Persiapan dan Analisis
Durasi: 1 hari
Kegiatan:
- Menentukan fitur MVP.
- Membuat ERD.
- Membuat wireframe.
- Menentukan role user.
- Menyiapkan repository GitHub.

Tahap 2 - Setup Project
Durasi: 1 hari
Kegiatan:
- Setup Laravel.
- Setup React.
- Setup MySQL.
- Setup Sanctum.
- Setup Tailwind.
- Setup struktur folder.

Tahap 3 - Backend Core
Durasi: 2 hari
Kegiatan:
- Membuat migration database.
- Membuat model dan relasi.
- Membuat API auth.
- Membuat API UMKM.
- Membuat API sumber energi.
- Membuat API dashboard.

Tahap 4 - Frontend Core
Durasi: 2 hari
Kegiatan:
- Membuat layout utama.
- Membuat halaman login/register.
- Membuat dashboard role.
- Membuat CRUD UMKM.
- Membuat CRUD sumber energi.

Tahap 5 - AI Recommendation
Durasi: 2 hari
Kegiatan:
- Membuat formula scoring.
- Membuat service rekomendasi.
- Membuat perhitungan jarak.
- Integrasi AI API.
- Menampilkan hasil rekomendasi di dashboard.

Tahap 6 - Map dan Monitoring Dampak
Durasi: 2 hari
Kegiatan:
- Integrasi Leaflet.
- Menampilkan marker UMKM dan energi.
- Membuat laporan dampak.
- Membuat grafik penghematan dan emisi.

Tahap 7 - Marketplace dan Kemitraan
Durasi: 1 hari
Kegiatan:
- Membuat CRUD produk UMKM.
- Membuat pengajuan kerja sama.
- Membuat status kemitraan.

Tahap 8 - Testing dan Deployment
Durasi: 1 hari
Kegiatan:
- Testing API.
- Testing frontend.
- Fix bug.
- Deploy backend.
- Deploy frontend.
- Menyiapkan akun demo.

Tahap 9 - Persiapan Presentasi
Durasi: 1 hari
Kegiatan:
- Membuat slide.
- Membuat video demo jika diperlukan.
- Menyiapkan script presentasi.
- Menyiapkan data dummy yang menarik.

Total estimasi: 13 hari

============================================================
13. PRIORITAS PENGEMBANGAN FITUR
============================================================

13.1 Wajib Selesai
- Login dan role user.
- CRUD UMKM.
- CRUD sumber energi.
- Dashboard statistik.
- Peta lokasi.
- AI scoring prioritas.
- Rekomendasi distribusi.
- Monitoring dampak dasar.

13.2 Bagus Jika Selesai
- Marketplace UMKM.
- Pengajuan kemitraan.
- Export PDF.
- Admin panel Filament.

13.3 Opsional
- Realtime dashboard.
- Chatbot AI.
- Notifikasi email.
- Integrasi payment atau donasi.

============================================================
14. DATA DUMMY UNTUK DEMO
============================================================

14.1 Contoh Sumber Energi
1. PLTS Desa Sumber Makmur
   - Type: Solar
   - Capacity: 5000 kWh
   - Available: 2500 kWh
   - Status: Active

2. Biomassa Agro Mandiri
   - Type: Biomass
   - Capacity: 3000 kWh
   - Available: 1200 kWh
   - Status: Active

3. Mikrohidro Kali Sejahtera
   - Type: Hydro
   - Capacity: 4000 kWh
   - Available: 1800 kWh
   - Status: Active

14.2 Contoh UMKM
1. UMKM Pengolahan Keripik Pisang
   - Sector: Food Processing
   - Monthly Energy Need: 900 kWh
   - Employee Count: 12
   - Current Energy Cost: Rp 2.500.000

2. UMKM Cold Storage Ikan
   - Sector: Fisheries
   - Monthly Energy Need: 1500 kWh
   - Employee Count: 20
   - Current Energy Cost: Rp 4.200.000

3. UMKM Pengeringan Kopi
   - Sector: Agriculture
   - Monthly Energy Need: 1100 kWh
   - Employee Count: 15
   - Current Energy Cost: Rp 3.000.000

============================================================
15. RISIKO DAN SOLUSI
============================================================

Risiko 1: AI API tidak dapat diakses saat demo.
Solusi:
- Siapkan fallback rule-based recommendation.
- Simpan hasil rekomendasi dummy di database.

Risiko 2: Waktu pengembangan terbatas.
Solusi:
- Fokus pada MVP.
- Gunakan Filament untuk mempercepat admin panel.
- Gunakan data dummy yang sudah siap.

Risiko 3: Fitur terlalu banyak.
Solusi:
- Prioritaskan dashboard, map, scoring, dan rekomendasi.
- Marketplace dibuat sederhana.

Risiko 4: Deployment bermasalah.
Solusi:
- Siapkan deployment lokal dan online.
- Siapkan video demo cadangan.

Risiko 5: Data real sulit didapat.
Solusi:
- Gunakan data simulasi realistis.
- Jelaskan bahwa sistem dapat diintegrasikan dengan data pemerintah/penyedia energi pada tahap lanjut.

============================================================
16. RENCANA KEBERLANJUTAN
============================================================

Tahap 1 - MVP Hackathon
- Sistem dapat mencatat UMKM dan sumber energi.
- Sistem dapat menghasilkan rekomendasi distribusi energi.
- Sistem dapat menampilkan dashboard dan peta.

Tahap 2 - Pilot Project Daerah
- Sistem diuji pada satu kecamatan atau desa.
- Data UMKM dan energi dikumpulkan melalui pemerintah daerah.
- Sistem digunakan untuk menentukan prioritas bantuan energi.

Tahap 3 - Integrasi Data Nyata
- Integrasi dengan data cuaca.
- Integrasi dengan data energi dari penyedia energi.
- Integrasi dengan data UMKM dari dinas koperasi/UMKM.

Tahap 4 - Ekosistem Kemitraan
- Menambahkan fitur marketplace lebih lengkap.
- Menambahkan fitur investor matching.
- Menambahkan fitur program bantuan energi.

Tahap 5 - Skalabilitas Nasional
- Sistem dapat digunakan lintas daerah.
- Pemerintah, koperasi, dan penyedia energi dapat menjadi mitra utama.
- Data dapat digunakan untuk pengambilan kebijakan energi bersih.

============================================================
17. POIN KEUNGGULAN UNTUK PRESENTASI
============================================================

1. Solusi sesuai dengan tema energi berkelanjutan dan swasembada ekonomi.
2. AI memiliki fungsi jelas, yaitu scoring prioritas dan rekomendasi distribusi.
3. Sistem memiliki dampak sosial-ekonomi yang dapat diukur.
4. Sistem mendukung banyak aktor: UMKM, pemerintah, penyedia energi, investor, dan koperasi.
5. Sistem berbasis web sehingga mudah diakses.
6. Menggunakan tech stack populer dan realistis: Laravel, MySQL, React.
7. Memiliki peta lokasi untuk memperkuat visualisasi masalah dan solusi.
8. Memiliki peluang keberlanjutan sebagai sistem pendukung keputusan pemerintah daerah.

============================================================
18. OUTPUT AKHIR YANG DIHARAPKAN
============================================================

Output sistem:
- Web dashboard EnergEco GlobalChain.
- API backend Laravel.
- Database MySQL.
- Admin panel.
- Peta potensi energi dan UMKM.
- AI recommendation engine.
- Laporan dampak.
- Marketplace/kemitraan sederhana.
- Dokumentasi API.
- Pitch deck presentasi.

============================================================
19. KESIMPULAN
============================================================

EnergEco GlobalChain dapat dikembangkan secara realistis menggunakan Laravel, MySQL, dan React. Stack ini cocok untuk hackathon karena cepat dibuat, mudah dipahami, mudah dideploy, dan cukup kuat untuk membangun sistem dashboard, peta, rekomendasi AI, serta monitoring dampak.

Fokus utama pengembangan sebaiknya diarahkan pada fitur inti, yaitu manajemen data UMKM, manajemen sumber energi, peta lokasi, AI scoring, rekomendasi distribusi energi, dan dashboard dampak. Fitur marketplace dan kemitraan dapat menjadi nilai tambah setelah fitur utama selesai.
