# UI/UX Planning — EnergEco GlobalChain

## 1. Identitas Produk

**Nama Produk:** EnergEco GlobalChain  
**Jenis Produk:** Web Application berbasis AI  
**Kategori Lomba:** Hackathon Web Application  
**Tema:** Sinergi Teknologi Global: Memberdayakan Energi Berkelanjutan dan Swasembada Ekonomi  
**Platform:** Website responsif untuk desktop dan mobile  

EnergEco GlobalChain adalah platform digital berbasis AI untuk membantu pemetaan, pemantauan, dan optimasi distribusi energi bersih kepada pelaku ekonomi lokal seperti UMKM, koperasi, pemerintah daerah, penyedia energi, dan mitra/investor.

Produk ini dibagi menjadi dua area utama:

1. **Public/User App** menggunakan React.
2. **Admin Panel** menggunakan Filament Laravel.

---

## 2. Tujuan UI/UX

Tujuan utama desain UI/UX EnergEco GlobalChain adalah membuat sistem yang terlihat profesional, mudah dipahami juri, dan realistis untuk diimplementasikan sebagai demo hackathon.

### Tujuan Utama

- Mempermudah UMKM mendaftarkan usaha dan kebutuhan energi.
- Membantu pemerintah daerah melihat wilayah prioritas distribusi energi bersih.
- Membantu penyedia energi mengelola kapasitas energi bersih.
- Membantu investor/mitra menemukan peluang kemitraan dengan UMKM lokal.
- Menampilkan rekomendasi AI secara jelas, transparan, dan mudah dijelaskan.
- Menyediakan dashboard visual yang menunjukkan dampak energi bersih terhadap ekonomi lokal.

### Prinsip UX

- **Simple but powerful:** Tampilan mudah dipahami, tetapi fitur terlihat kuat.
- **Data-driven:** Keputusan ditampilkan berdasarkan data, skor, grafik, dan peta.
- **Trustworthy:** Rekomendasi AI harus memiliki alasan yang jelas.
- **Responsive:** Nyaman digunakan di desktop, tablet, dan mobile.
- **Role-based experience:** Tampilan disesuaikan dengan peran pengguna.

---

## 3. Target Pengguna

## 3.1 UMKM

UMKM adalah pengguna utama yang membutuhkan akses energi bersih untuk menunjang produksi.

### Kebutuhan UMKM

- Mendaftarkan profil usaha.
- Mengisi kebutuhan energi bulanan.
- Melihat status prioritas bantuan energi.
- Melihat estimasi penghematan biaya.
- Menampilkan produk lokal di marketplace.
- Mengajukan kerja sama dengan mitra.

### UI yang Dibutuhkan

- Dashboard ringkas.
- Form profil usaha.
- Form kebutuhan energi.
- Halaman rekomendasi AI.
- Halaman produk.
- Halaman status bantuan.

---

## 3.2 Pemerintah Daerah

Pemerintah daerah membutuhkan sistem untuk melihat prioritas wilayah dan dampak ekonomi.

### Kebutuhan Pemerintah

- Melihat peta wilayah prioritas.
- Melihat ranking UMKM/sektor yang membutuhkan energi bersih.
- Melihat dampak ekonomi dan lingkungan.
- Mengambil keputusan distribusi berdasarkan rekomendasi AI.

### UI yang Dibutuhkan

- Dashboard wilayah.
- Heatmap prioritas.
- Grafik dampak ekonomi.
- Tabel rekomendasi distribusi.
- Laporan ringkas.

---

## 3.3 Penyedia Energi

Penyedia energi bertugas mengelola data sumber energi bersih.

### Kebutuhan Penyedia Energi

- Menambahkan sumber energi.
- Mengatur kapasitas energi.
- Memantau status distribusi.
- Melihat permintaan energi dari UMKM.

### UI yang Dibutuhkan

- Dashboard kapasitas energi.
- Form sumber energi.
- Map lokasi energi.
- Tabel permintaan energi.

---

## 3.4 Investor / Mitra Strategis

Investor atau mitra membutuhkan informasi peluang kerja sama dengan UMKM lokal.

### Kebutuhan Investor / Mitra

- Melihat UMKM potensial.
- Melihat skor dampak ekonomi.
- Mengajukan kemitraan.
- Melihat produk lokal yang didukung energi bersih.

### UI yang Dibutuhkan

- Marketplace UMKM.
- Halaman detail UMKM.
- Halaman peluang kemitraan.
- Form pengajuan kerja sama.

---

## 3.5 Admin

Admin mengelola keseluruhan data sistem melalui Filament.

### Kebutuhan Admin

- Mengelola pengguna.
- Memvalidasi data UMKM.
- Mengelola sumber energi.
- Memantau hasil AI.
- Mengelola marketplace.
- Mengelola laporan dampak.

### UI yang Digunakan

- Filament Admin Panel.

---

# 4. Pembagian UI Berdasarkan Platform

## 4.1 React Frontend

React digunakan untuk semua tampilan publik dan user dashboard.

### Halaman React

- Landing Page
- Login/Register
- Dashboard UMKM
- Dashboard Pemerintah
- Dashboard Penyedia Energi
- Dashboard Investor/Mitra
- Peta Potensi Energi dan UMKM
- AI Recommendation Page
- Marketplace UMKM
- Detail UMKM
- Detail Produk
- Partnership Request
- Profile Settings
- Notification Center

---

## 4.2 Filament Admin Panel

Filament digunakan khusus untuk admin internal.

### Halaman Filament

- Admin Dashboard
- User Management
- UMKM Management
- Energy Source Management
- Energy Distribution Management
- AI Recommendation Monitoring
- Impact Report Management
- Product Moderation
- Partnership Management
- System Settings

---

# 5. Tools UI/UX yang Digunakan

## 5.1 Design & Prototype

| Tools | Fungsi |
|---|---|
| Figma | Desain UI, wireframe, prototype interaktif |
| FigJam | User flow, brainstorming, information architecture |
| Whimsical / Draw.io | Diagram flow sistem dan arsitektur |
| Notion / Markdown | Dokumentasi UI/UX dan planning |

## 5.2 Frontend Development

| Tools | Fungsi |
|---|---|
| React | Library utama frontend |
| Vite | Build tool React yang cepat |
| TypeScript | Menjaga struktur kode lebih aman dan rapi |
| Tailwind CSS | Styling cepat dan konsisten |
| shadcn/ui | Komponen UI modern dan reusable |
| Lucide React | Icon set modern |
| React Router | Navigasi antar halaman |
| TanStack Query / React Query | Fetching, caching, dan sinkronisasi data API |
| Axios | HTTP request ke Laravel API |
| React Hook Form | Form handling |
| Zod | Validasi form |
| Recharts | Visualisasi grafik dashboard |
| Leaflet / React Leaflet | Peta lokasi energi dan UMKM |
| Framer Motion | Animasi ringan untuk landing page |
| Sonner / Toast | Notifikasi aksi user |
| Zustand | State management ringan |

## 5.3 Admin Panel

| Tools | Fungsi |
|---|---|
| Laravel Filament | Admin panel, CRUD, dashboard, widget |
| Filament Shield | Role & permission untuk Filament |
| Filament Widgets | Statistik dan grafik admin |
| Laravel Policies | Pembatasan akses data |

## 5.4 Backend Support untuk UI

| Tools | Fungsi |
|---|---|
| Laravel API | Backend utama untuk React |
| Laravel Sanctum | Autentikasi token API |
| MySQL | Database utama |
| Laravel Storage | Penyimpanan gambar produk dan dokumen |
| Laravel Queue | Proses rekomendasi AI dan laporan |
| Gemini API / OpenAI API | Insight dan rekomendasi AI |

---

# 6. Design System

## 6.1 Gaya Visual

Konsep visual yang digunakan adalah:

**Clean, modern, green-energy, data-driven, dan professional.**

UI harus memberi kesan:

- Ramah lingkungan.
- Teknologi modern.
- Cocok untuk pemerintahan dan bisnis.
- Mudah dipahami masyarakat umum.
- Terlihat kuat saat presentasi hackathon.

---

## 6.2 Warna Utama

### Primary Color

- Emerald / Green untuk energi bersih dan keberlanjutan.

```css
--primary: #059669;
--primary-dark: #047857;
--primary-light: #D1FAE5;
```

### Secondary Color

- Blue / Cyan untuk teknologi, data, dan AI.

```css
--secondary: #0284C7;
--secondary-light: #E0F2FE;
```

### Accent Color

- Lime / Yellow untuk highlight energi dan optimisme.

```css
--accent: #A3E635;
--warning: #FACC15;
```

### Neutral Color

```css
--background: #F8FAFC;
--surface: #FFFFFF;
--text: #0F172A;
--muted: #64748B;
--border: #E2E8F0;
```

---

## 6.3 Font

### Rekomendasi Font

- **Inter** untuk UI modern.
- **Plus Jakarta Sans** untuk tampilan lebih elegan.
- **Poppins** untuk heading jika ingin lebih friendly.

### Kombinasi Font

```text
Heading : Plus Jakarta Sans
Body    : Inter
```

---

## 6.4 Komponen UI Utama

Komponen yang perlu dibuat di React:

- Button
- Input
- Select
- Textarea
- Card
- Badge
- Modal
- Drawer
- Tabs
- Table
- Data Card
- Stat Card
- Chart Card
- Map Card
- AI Insight Card
- Notification Toast
- Stepper Form
- Empty State
- Loading Skeleton
- Alert Dialog

---

## 6.5 Icon Style

Gunakan **Lucide React**.

Contoh icon:

- Zap untuk energi.
- Leaf untuk keberlanjutan.
- Building2 untuk UMKM.
- MapPin untuk lokasi.
- BrainCircuit untuk AI.
- Handshake untuk kemitraan.
- BarChart3 untuk statistik.
- Users untuk pengguna.

---

# 7. Information Architecture

## 7.1 Struktur Navigasi Public

```text
Landing Page
├── Home
├── About
├── Features
├── SDGs
├── How It Works
├── Marketplace Preview
├── Login
└── Register
```

---

## 7.2 Struktur Navigasi User Dashboard

```text
Dashboard
├── Overview
├── Energy Map
├── AI Recommendation
├── Energy Request
├── Impact Report
├── Marketplace
├── Partnership
├── Notification
└── Profile
```

---

## 7.3 Struktur Navigasi Admin Filament

```text
Admin Panel
├── Dashboard
├── Users
├── Businesses / UMKM
├── Energy Sources
├── Energy Requests
├── Distribution Recommendations
├── Impact Reports
├── Products
├── Partnerships
├── AI Logs
└── Settings
```

---

# 8. User Flow

## 8.1 Flow UMKM

```text
Register
↓
Pilih role UMKM
↓
Lengkapi profil usaha
↓
Input lokasi dan kebutuhan energi
↓
Sistem menghitung skor prioritas
↓
UMKM melihat rekomendasi AI
↓
UMKM dapat mengajukan bantuan energi
↓
UMKM menambahkan produk ke marketplace
↓
UMKM menerima peluang kemitraan
```

---

## 8.2 Flow Pemerintah Daerah

```text
Login
↓
Masuk dashboard pemerintah
↓
Lihat peta prioritas wilayah
↓
Lihat ranking UMKM/sektor
↓
Buka rekomendasi distribusi energi
↓
Validasi prioritas
↓
Unduh laporan dampak
```

---

## 8.3 Flow Penyedia Energi

```text
Login
↓
Masuk dashboard penyedia energi
↓
Tambah sumber energi bersih
↓
Input kapasitas dan lokasi
↓
Lihat permintaan energi dari UMKM
↓
Update status distribusi
↓
Pantau kapasitas tersedia
```

---

## 8.4 Flow Investor / Mitra

```text
Login
↓
Masuk dashboard mitra
↓
Lihat UMKM prioritas
↓
Filter berdasarkan sektor/lokasi/dampak
↓
Buka detail UMKM
↓
Ajukan kemitraan
↓
Pantau status pengajuan
```

---

# 9. Halaman Public React

## 9.1 Landing Page

Landing page adalah halaman pertama yang dilihat juri dan pengguna umum. Halaman ini harus paling menarik secara visual.

### Section Landing Page

1. Navbar
2. Hero Section
3. Problem Section
4. Solution Section
5. Feature Section
6. AI Recommendation Preview
7. Energy Map Preview
8. SDGs Section
9. Marketplace Preview
10. Impact Statistics
11. How It Works
12. CTA Section
13. Footer

### Hero Section

Konten:

- Judul utama.
- Deskripsi singkat.
- Tombol “Mulai Sekarang”.
- Tombol “Lihat Demo AI”.
- Ilustrasi peta energi/UMKM.

Contoh copywriting:

```text
Distribusi Energi Bersih Berbasis AI untuk Mendorong Ekonomi Lokal Berkelanjutan
```

### Problem Section

Menjelaskan masalah:

- Akses energi bersih belum merata.
- UMKM sulit berkembang karena biaya energi tinggi.
- Pemerintah sulit menentukan prioritas distribusi.
- Data energi dan ekonomi lokal belum terintegrasi.

### Solution Section

Menjelaskan solusi:

- Pemetaan potensi energi.
- Analisis kebutuhan UMKM.
- Rekomendasi AI.
- Monitoring dampak ekonomi dan emisi.

### Impact Statistics

Statistik yang bisa ditampilkan:

- Total UMKM terdaftar.
- Total sumber energi bersih.
- Estimasi penghematan biaya.
- Estimasi reduksi emisi.
- Total peluang kemitraan.

---

## 9.2 Login & Register

### Login Page

Input:

- Email
- Password

Aksi:

- Login
- Forgot Password
- Register

### Register Page

Input:

- Nama lengkap
- Email
- Password
- Role

Pilihan role:

- UMKM
- Pemerintah Daerah
- Penyedia Energi
- Investor / Mitra

Setelah register, user diarahkan ke onboarding sesuai role.

---

## 9.3 Onboarding Page

Onboarding digunakan untuk mengumpulkan data awal sesuai role.

### Onboarding UMKM

Step:

1. Data usaha
2. Lokasi usaha
3. Kebutuhan energi
4. Kapasitas produksi
5. Review data

### Onboarding Penyedia Energi

Step:

1. Data perusahaan/instansi
2. Jenis energi
3. Lokasi sumber energi
4. Kapasitas energi
5. Review data

### Onboarding Pemerintah

Step:

1. Data instansi
2. Wilayah kerja
3. Fokus program
4. Review data

### Onboarding Investor/Mitra

Step:

1. Data mitra
2. Jenis kemitraan
3. Sektor yang diminati
4. Wilayah prioritas
5. Review data

---

# 10. Halaman Dashboard React Berdasarkan Role

## 10.1 Dashboard UMKM

### Tujuan

Memberikan ringkasan kondisi energi, status prioritas, rekomendasi AI, dan peluang kemitraan.

### Komponen

- Welcome Card
- Energy Need Card
- Priority Score Card
- AI Recommendation Card
- Cost Saving Card
- Emission Reduction Card
- Product Performance Card
- Partnership Status Card

### Layout Desktop

```text
Topbar
Sidebar
Main Content
├── Stat Cards
├── AI Recommendation
├── Energy Usage Chart
├── Impact Summary
└── Recent Partnership Requests
```

### Layout Mobile

```text
Topbar
Bottom Navigation
Content Cards Stacked
```

### Fitur CRUD UMKM

- Create profile usaha.
- Read detail usaha.
- Update data usaha.
- Delete produk marketplace.
- Create request bantuan energi.
- Update kebutuhan energi.

---

## 10.2 Dashboard Pemerintah

### Tujuan

Memantau prioritas distribusi energi di wilayah tertentu.

### Komponen

- Total UMKM Card
- Energy Gap Card
- Priority Area Card
- Distribution Recommendation Card
- Impact Chart
- Priority Ranking Table
- Map Heatmap

### Fitur Utama

- Filter berdasarkan wilayah.
- Filter berdasarkan sektor UMKM.
- Lihat ranking prioritas.
- Lihat rekomendasi AI.
- Export laporan.

---

## 10.3 Dashboard Penyedia Energi

### Tujuan

Mengelola kapasitas dan distribusi sumber energi bersih.

### Komponen

- Total Capacity Card
- Available Energy Card
- Distributed Energy Card
- Energy Source Table
- Energy Request Table
- Distribution Status Chart
- Map Energy Source

### Fitur CRUD

- Create sumber energi.
- Read sumber energi.
- Update kapasitas energi.
- Update status distribusi.
- Delete sumber energi jika belum digunakan.

---

## 10.4 Dashboard Investor / Mitra

### Tujuan

Menampilkan peluang kemitraan dengan UMKM prioritas.

### Komponen

- Recommended UMKM Card
- Economic Impact Card
- Partnership Opportunity List
- Marketplace Product List
- Filter Sector
- Filter Location

### Fitur CRUD

- Create pengajuan kemitraan.
- Read daftar UMKM.
- Update proposal kemitraan.
- Cancel pengajuan kemitraan.

---

# 11. Halaman AI Recommendation

Halaman ini adalah fitur paling penting karena menunjukkan nilai AI dalam sistem.

## 11.1 Komponen Halaman

- AI Summary Card
- Priority Score Breakdown
- Recommended Energy Source
- Recommended Distribution Route
- Economic Impact Estimate
- Emission Reduction Estimate
- Explanation Section
- Action Button

## 11.2 Informasi yang Ditampilkan

```text
Nama UMKM
Lokasi
Kebutuhan energi
Skor prioritas
Sumber energi terdekat
Estimasi biaya sebelum
Estimasi biaya sesudah
Estimasi penghematan
Estimasi pengurangan emisi
Alasan rekomendasi AI
```

## 11.3 Score Breakdown

Contoh indikator:

| Indikator | Bobot |
|---|---|
| Kebutuhan energi | 30% |
| Dampak ekonomi | 25% |
| Jumlah pekerja | 15% |
| Jarak ke sumber energi | 15% |
| Potensi reduksi emisi | 15% |

## 11.4 Tampilan AI Insight

Gunakan card khusus:

```text
AI Insight
Sistem merekomendasikan UMKM Batik Lestari sebagai prioritas tinggi karena memiliki kebutuhan energi besar, jumlah pekerja tinggi, dan berada dekat dengan sumber energi surya berkapasitas cukup.
```

## 11.5 UX Penting

AI tidak boleh terlihat seperti kotak hitam. Setiap rekomendasi harus memiliki:

- Skor.
- Alasan.
- Data pendukung.
- Estimasi dampak.
- Rekomendasi tindakan.

---

# 12. Halaman Energy Map

## 12.1 Tujuan

Menampilkan peta lokasi sumber energi bersih dan UMKM.

## 12.2 Tools

- Leaflet
- React Leaflet
- OpenStreetMap

## 12.3 Layer Peta

- Layer UMKM
- Layer sumber energi
- Layer wilayah prioritas
- Layer distribusi energi

## 12.4 Marker

### Marker UMKM

- Icon: Building2
- Warna: biru/hijau
- Popup: nama usaha, sektor, kebutuhan energi, skor prioritas

### Marker Sumber Energi

- Icon: Zap / Leaf
- Warna: emerald/yellow
- Popup: nama sumber, jenis energi, kapasitas, status

### Marker Prioritas Tinggi

- Warna merah/oranye untuk menunjukkan urgensi.

## 12.5 Filter Peta

- Jenis energi
- Sektor UMKM
- Wilayah
- Skor prioritas
- Status distribusi

---

# 13. Halaman Marketplace UMKM

## 13.1 Tujuan

Menampilkan produk lokal dari UMKM yang didukung energi bersih.

## 13.2 Komponen

- Product Card
- UMKM Profile Badge
- Clean Energy Badge
- Search Bar
- Filter Category
- Filter Location
- Product Detail Modal/Page

## 13.3 Product Card

Isi:

- Foto produk
- Nama produk
- Nama UMKM
- Harga
- Lokasi
- Badge “Powered by Clean Energy”

## 13.4 Fitur CRUD UMKM

- Tambah produk.
- Edit produk.
- Hapus produk.
- Upload gambar.

---

# 14. Halaman Partnership

## 14.1 Tujuan

Menghubungkan UMKM, penyedia energi, pemerintah, koperasi, dan investor.

## 14.2 Komponen

- Partnership Opportunity Card
- Partnership Request Form
- Partnership Status Table
- Detail Request

## 14.3 Status Kemitraan

```text
Pending
Reviewed
Accepted
Rejected
Completed
```

## 14.4 Fitur

- Investor mengajukan kemitraan.
- UMKM menerima/menolak pengajuan.
- Pemerintah dapat melihat daftar kemitraan strategis.
- Admin dapat memoderasi pengajuan.

---

# 15. Admin Panel Filament

## 15.1 Tujuan Filament

Filament digunakan untuk mempercepat pembuatan admin panel dan menunjukkan bahwa sistem memiliki backend management yang kuat.

## 15.2 Resource Filament

### UserResource

Fungsi:

- Melihat semua user.
- Mengatur role.
- Menonaktifkan user.

Field:

- Name
- Email
- Role
- Status
- Created At

---

### BusinessResource

Fungsi:

- Validasi UMKM.
- Edit data UMKM.
- Lihat kebutuhan energi.

Field:

- Name
- Owner
- Sector
- Location
- Monthly Energy Need
- Priority Score
- Verification Status

---

### EnergySourceResource

Fungsi:

- Mengelola sumber energi.

Field:

- Name
- Type
- Capacity
- Available Capacity
- Location
- Status

---

### EnergyRequestResource

Fungsi:

- Mengelola permintaan bantuan energi.

Field:

- Business
- Energy Need
- Status
- Priority Score
- AI Recommendation

---

### RecommendationResource

Fungsi:

- Memantau hasil AI.

Field:

- Business
- Recommended Source
- Priority Score
- Reason
- Estimated Saving
- Estimated Emission Reduction

---

### ProductResource

Fungsi:

- Moderasi produk marketplace.

Field:

- Product Name
- Business
- Price
- Category
- Status

---

### PartnershipResource

Fungsi:

- Monitoring kemitraan.

Field:

- Sender
- Receiver
- Type
- Status
- Message

---

## 15.3 Widget Filament

Widget yang perlu dibuat:

- Total UMKM
- Total Energy Source
- Total Energy Distributed
- Total Partnership
- Average Priority Score
- Estimated Cost Saving
- Estimated Emission Reduction
- AI Recommendation Chart
- Energy Source Type Chart

---

# 16. Responsiveness Strategy

## 16.1 Desktop

Desktop digunakan untuk dashboard penuh dan presentasi juri.

Karakteristik:

- Sidebar tetap.
- Banyak data dalam grid.
- Grafik dan peta berdampingan.
- Tabel lengkap.

## 16.2 Tablet

Karakteristik:

- Sidebar bisa collapse.
- Grid 2 kolom.
- Tabel disederhanakan.

## 16.3 Mobile

Karakteristik:

- Bottom navigation.
- Card satu kolom.
- Form step-by-step.
- Tabel diganti menjadi list card.
- Map full width.

---

# 17. Accessibility

Agar UI terlihat profesional, perhatikan aksesibilitas.

## Prinsip

- Kontras teks harus jelas.
- Button memiliki label yang mudah dipahami.
- Form memiliki error message.
- Icon tidak boleh menjadi satu-satunya informasi.
- Ukuran font minimal 14px.
- Input mudah diklik di mobile.

## Checklist

- Alt text untuk gambar produk.
- Label untuk semua input.
- Focus state untuk keyboard navigation.
- Toast notification untuk feedback.
- Loading state saat data diproses.
- Empty state jika data belum tersedia.

---

# 18. UX Microcopy

Gunakan kalimat yang jelas dan meyakinkan.

## Contoh Microcopy

### Saat UMKM mengisi kebutuhan energi

```text
Masukkan estimasi kebutuhan energi bulanan agar sistem dapat menghitung prioritas distribusi energi bersih untuk usaha Anda.
```

### Saat AI menampilkan rekomendasi

```text
Rekomendasi ini dihitung berdasarkan kebutuhan energi, dampak ekonomi, lokasi, kapasitas sumber energi, dan potensi pengurangan emisi.
```

### Saat data kosong

```text
Belum ada data energi. Tambahkan sumber energi untuk mulai membuat rekomendasi distribusi.
```

### Saat berhasil submit

```text
Data berhasil disimpan. Sistem akan memperbarui rekomendasi energi secara otomatis.
```

---

# 19. Route Frontend React

```text
/
/login
/register
/onboarding
/dashboard
/dashboard/energy-map
/dashboard/recommendations
/dashboard/energy-request
/dashboard/impact-report
/dashboard/marketplace
/dashboard/marketplace/create
/dashboard/marketplace/:id
/dashboard/partnerships
/dashboard/profile
```

## Role-Based Route

```text
/umkm/dashboard
/government/dashboard
/provider/dashboard
/investor/dashboard
```

Atau gunakan satu dashboard yang isi menunya berubah berdasarkan role.

---

# 20. Komponen Folder React

```text
src/
├── assets/
├── components/
│   ├── ui/
│   ├── layout/
│   ├── dashboard/
│   ├── forms/
│   ├── charts/
│   ├── maps/
│   └── cards/
│
├── features/
│   ├── auth/
│   ├── businesses/
│   ├── energy-sources/
│   ├── recommendations/
│   ├── marketplace/
│   ├── partnerships/
│   └── impact-reports/
│
├── hooks/
├── lib/
├── pages/
├── routes/
├── services/
├── stores/
├── types/
└── main.tsx
```

---

# 21. API Integration Design

## 21.1 Axios Config

```ts
import axios from "axios";

export const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
});

api.interceptors.request.use((config) => {
  const token = localStorage.getItem("token");

  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }

  return config;
});
```

## 21.2 React Query Example

```ts
import { useQuery } from "@tanstack/react-query";
import { api } from "@/lib/api";

export function useRecommendations() {
  return useQuery({
    queryKey: ["recommendations"],
    queryFn: async () => {
      const response = await api.get("/recommendations");
      return response.data.data;
    },
  });
}
```

---

# 22. Form Design

## 22.1 Tools

- React Hook Form
- Zod
- shadcn/ui Form

## 22.2 Contoh Validasi UMKM

```ts
import { z } from "zod";

export const businessSchema = z.object({
  name: z.string().min(3, "Nama usaha minimal 3 karakter"),
  sector: z.string().min(1, "Sektor usaha wajib dipilih"),
  address: z.string().min(5, "Alamat wajib diisi"),
  latitude: z.number(),
  longitude: z.number(),
  monthly_energy_need: z.number().min(1),
  employee_count: z.number().min(1),
  current_energy_cost: z.number().min(0),
});
```

---

# 23. Dashboard Data Visualization

## 23.1 Grafik yang Dibutuhkan

| Grafik | Tools | Fungsi |
|---|---|---|
| Line Chart | Recharts | Tren kebutuhan energi |
| Bar Chart | Recharts | Perbandingan sektor UMKM |
| Pie Chart | Recharts | Jenis sumber energi |
| Area Chart | Recharts | Dampak penghematan biaya |
| Radar Chart | Recharts | Skor prioritas multidimensi |

## 23.2 Stat Card

Contoh stat card:

```text
Total UMKM: 128
Sumber Energi: 24
Distribusi Aktif: 46
Estimasi Hemat Biaya: Rp 42.000.000
Reduksi Emisi: 12.4 ton CO2
```

---

# 24. UI State

Setiap halaman harus memiliki state berikut:

## Loading State

Gunakan skeleton loading agar UI terlihat profesional.

## Empty State

Contoh:

```text
Belum ada rekomendasi AI. Lengkapi data kebutuhan energi untuk mendapatkan rekomendasi.
```

## Error State

Contoh:

```text
Gagal memuat data. Periksa koneksi Anda atau coba beberapa saat lagi.
```

## Success State

Contoh:

```text
Data berhasil diperbarui.
```

---

# 25. Wireframe Textual

## 25.1 Landing Page Wireframe

```text
+--------------------------------------------------+
| Navbar: Logo | Features | SDGs | Marketplace | Login |
+--------------------------------------------------+
| Hero                                             |
| Title + Description + CTA                       |
| Right: Map Illustration / Dashboard Preview      |
+--------------------------------------------------+
| Problem Cards                                    |
+--------------------------------------------------+
| Solution / How AI Works                          |
+--------------------------------------------------+
| Feature Grid                                     |
+--------------------------------------------------+
| AI Recommendation Preview                        |
+--------------------------------------------------+
| Map Preview                                      |
+--------------------------------------------------+
| Impact Statistics                                |
+--------------------------------------------------+
| Footer                                           |
+--------------------------------------------------+
```

## 25.2 Dashboard Wireframe

```text
+--------------------------------------------------+
| Sidebar | Topbar                                 |
|         |----------------------------------------|
|         | Stat Cards                              |
|         |----------------------------------------|
|         | AI Insight | Map Preview                |
|         |----------------------------------------|
|         | Chart      | Table Recommendation        |
+--------------------------------------------------+
```

## 25.3 Mobile Wireframe

```text
+----------------------+
| Topbar               |
+----------------------+
| Stat Card            |
+----------------------+
| AI Insight Card      |
+----------------------+
| Chart Card           |
+----------------------+
| Map Card             |
+----------------------+
| Bottom Navigation    |
+----------------------+
```

---

# 26. MVP UI untuk Demo Hackathon

Jika waktu terbatas, prioritaskan halaman berikut:

## Prioritas 1

- Landing Page
- Login/Register
- Dashboard UMKM
- Peta Energi
- AI Recommendation
- Admin Filament Dashboard

## Prioritas 2

- Marketplace UMKM
- Partnership Request
- Dashboard Pemerintah
- Impact Report

## Prioritas 3

- Dashboard Penyedia Energi
- Dashboard Investor
- Notification
- Export Report

---

# 27. Alur Demo ke Juri

## Skenario Demo

1. Buka landing page EnergEco GlobalChain.
2. Jelaskan masalah energi bersih dan UMKM.
3. Login sebagai UMKM.
4. Tampilkan dashboard UMKM.
5. Input kebutuhan energi.
6. Buka AI Recommendation.
7. Tampilkan skor prioritas dan alasan rekomendasi.
8. Buka peta energi.
9. Tampilkan sumber energi terdekat.
10. Login admin Filament.
11. Tunjukkan data UMKM, sumber energi, dan hasil AI.
12. Tunjukkan dampak: hemat biaya, produktivitas, dan reduksi emisi.
13. Tutup dengan marketplace/kemitraan sebagai keberlanjutan ekonomi lokal.

---

# 28. Nilai Plus untuk Presentasi

Agar sistem terlihat lebih kuat, siapkan:

- Dummy data realistis.
- Grafik yang sudah terisi.
- Peta dengan beberapa marker.
- AI insight yang mudah dibaca.
- Admin panel Filament yang lengkap.
- Role-based login.
- Video/gif singkat alur sistem.
- Slide arsitektur UI dan backend.

---

# 29. Dummy Data untuk UI Demo

## Contoh UMKM

```text
UMKM Batik Lestari
Sektor: Kerajinan
Lokasi: Malang
Kebutuhan energi: 850 kWh/bulan
Biaya energi saat ini: Rp 2.500.000/bulan
Jumlah pekerja: 18
Skor prioritas: 87/100
```

## Contoh Sumber Energi

```text
PLTS Desa Sumber Makmur
Jenis: Solar
Kapasitas: 15.000 kWh/bulan
Tersedia: 6.500 kWh/bulan
Status: Aktif
```

## Contoh AI Recommendation

```text
UMKM Batik Lestari direkomendasikan sebagai prioritas tinggi karena memiliki kebutuhan energi besar, menyerap 18 tenaga kerja lokal, dan berada dalam radius distribusi efisien dari PLTS Desa Sumber Makmur.
```

---

# 30. Timeline UI/UX dan Frontend

## Minggu 1 — Research & Planning

- Finalisasi user persona.
- Buat user flow.
- Buat sitemap.
- Tentukan design system.
- Buat wireframe low fidelity.

## Minggu 2 — Design High Fidelity

- Desain landing page.
- Desain dashboard UMKM.
- Desain AI Recommendation.
- Desain Energy Map.
- Desain Marketplace.
- Desain Admin flow.

## Minggu 3 — Frontend Setup

- Setup React + Vite + TypeScript.
- Setup Tailwind.
- Setup shadcn/ui.
- Setup React Router.
- Setup Axios.
- Setup React Query.
- Setup layout dashboard.

## Minggu 4 — Implementasi Halaman Utama

- Landing page.
- Login/register.
- Dashboard UMKM.
- AI Recommendation.
- Energy Map.
- Marketplace.

## Minggu 5 — Integrasi API

- Integrasi auth.
- Integrasi data UMKM.
- Integrasi data energi.
- Integrasi rekomendasi AI.
- Integrasi marketplace.

## Minggu 6 — Polishing Demo

- Responsiveness.
- Loading state.
- Empty state.
- Error handling.
- Animasi ringan.
- Testing alur demo.
- Siapkan data dummy.

---

# 31. Checklist UI/UX

## Landing Page

- [ ] Hero section menarik.
- [ ] CTA jelas.
- [ ] Fitur utama terlihat.
- [ ] SDGs terlihat.
- [ ] Preview AI ada.
- [ ] Preview map ada.
- [ ] Responsif mobile.

## Dashboard

- [ ] Sidebar rapi.
- [ ] Stat card informatif.
- [ ] Grafik terbaca.
- [ ] AI insight jelas.
- [ ] Peta berjalan.
- [ ] Table memiliki filter/search.

## Form

- [ ] Validasi jelas.
- [ ] Error message mudah dipahami.
- [ ] Loading saat submit.
- [ ] Success notification.

## Admin Filament

- [ ] Resource utama tersedia.
- [ ] Widget dashboard tersedia.
- [ ] Role permission aktif.
- [ ] Data bisa difilter.
- [ ] Data dummy tersedia.

## Demo

- [ ] Semua menu utama bisa dibuka.
- [ ] Tidak ada halaman kosong tanpa empty state.
- [ ] Login role berjalan.
- [ ] API stabil.
- [ ] Tampilan desktop dan mobile rapi.

---

# 32. Rekomendasi Final UI Stack

## Public/User Frontend

```text
React
Vite
TypeScript
Tailwind CSS
shadcn/ui
React Router
TanStack Query
Axios
React Hook Form
Zod
Recharts
Leaflet
Framer Motion
Lucide React
Zustand
```

## Admin

```text
Laravel Filament
Filament Shield
Filament Widgets
Laravel Policies
```

## Design

```text
Figma
FigJam
Draw.io
Markdown Documentation
```

---

# 33. Kesimpulan

UI/UX EnergEco GlobalChain sebaiknya dibangun dengan pendekatan dua lapisan:

1. **Filament untuk admin internal**, karena cepat, kuat, dan cocok untuk CRUD serta monitoring.
2. **React untuk public dan user dashboard**, karena lebih fleksibel, modern, responsif, dan menarik untuk presentasi hackathon.

Meskipun arsitekturnya lebih rumit, pendekatan ini sangat cocok untuk demo sebelum lomba karena dapat menunjukkan kualitas sistem yang matang: ada frontend modern, admin panel profesional, role-based access, dashboard interaktif, peta energi, marketplace, dan AI recommendation yang terlihat nyata.
