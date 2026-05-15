<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Distribution;
use App\Models\EnergyNeed;
use App\Models\EnergySource;
use App\Models\ImpactReport;
use App\Models\Product;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Demo data from SRS section 20 (Lampiran).
     */
    public function run(): void
    {
        // ---- Regions ----
        $banyuwangi = Region::create([
            'name' => 'Banyuwangi',
            'province' => 'Jawa Timur',
            'city' => 'Banyuwangi',
            'district' => 'Kalibaru',
            'latitude' => -8.3460,
            'longitude' => 114.1537,
            'priority_level' => 'high',
        ]);

        $malang = Region::create([
            'name' => 'Malang',
            'province' => 'Jawa Timur',
            'city' => 'Malang',
            'district' => 'Singosari',
            'latitude' => -7.9787,
            'longitude' => 112.6375,
            'priority_level' => 'high',
        ]);

        $kediri = Region::create([
            'name' => 'Kediri',
            'province' => 'Jawa Timur',
            'city' => 'Kediri',
            'district' => 'Pare',
            'latitude' => -7.8140,
            'longitude' => 112.0131,
            'priority_level' => 'medium',
        ]);

        $probolinggo = Region::create([
            'name' => 'Probolinggo',
            'province' => 'Jawa Timur',
            'city' => 'Probolinggo',
            'district' => 'Mayangan',
            'latitude' => -7.7540,
            'longitude' => 113.2151,
            'priority_level' => 'medium',
        ]);

        // ---- Users ----
        $admin = User::create([
            'name' => 'Admin EnergEco',
            'email' => 'admin@energeco.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'status' => 'active',
        ]);
        $admin->assignRole('admin');

        $umkm1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@kopilestari.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'address' => 'Jl. Kalibaru No. 45, Banyuwangi',
            'status' => 'active',
        ]);
        $umkm1->assignRole('umkm');

        $umkm2 = User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@batiksurya.com',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'address' => 'Jl. Ijen No. 12, Malang',
            'status' => 'active',
        ]);
        $umkm2->assignRole('umkm');

        $umkm3 = User::create([
            'name' => 'Ahmad Hidayat',
            'email' => 'ahmad@tahumandiri.com',
            'password' => Hash::make('password'),
            'phone' => '081234567893',
            'address' => 'Jl. Pare No. 78, Kediri',
            'status' => 'active',
        ]);
        $umkm3->assignRole('umkm');

        $umkm4 = User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@ikanasap.com',
            'password' => Hash::make('password'),
            'phone' => '081234567894',
            'address' => 'Jl. Pelabuhan No. 33, Probolinggo',
            'status' => 'active',
        ]);
        $umkm4->assignRole('umkm');

        $gov = User::create([
            'name' => 'Pemerintah Jawa Timur',
            'email' => 'gov@jatim.go.id',
            'password' => Hash::make('password'),
            'phone' => '031123456',
            'address' => 'Gedung Negara, Surabaya',
            'status' => 'active',
        ]);
        $gov->assignRole('government');

        $provider = User::create([
            'name' => 'PT Solar Nusantara',
            'email' => 'info@solarnusantara.co.id',
            'password' => Hash::make('password'),
            'phone' => '021987654',
            'address' => 'Jl. Energi No. 1, Jakarta',
            'status' => 'active',
        ]);
        $provider->assignRole('provider');

        $partner = User::create([
            'name' => 'CV Mitra Hijau',
            'email' => 'contact@mitrahijau.com',
            'password' => Hash::make('password'),
            'phone' => '081298765432',
            'address' => 'Jl. Sudirman No. 100, Surabaya',
            'status' => 'active',
        ]);
        $partner->assignRole('partner');

        // ---- Businesses (SRS section 20.1) ----
        $biz1 = Business::create([
            'user_id' => $umkm1->id,
            'region_id' => $banyuwangi->id,
            'name' => 'Kopi Lestari',
            'sector' => 'Agroindustri',
            'description' => 'Usaha pengolahan kopi arabika lokal Banyuwangi dengan proses roasting dan packaging modern.',
            'address' => 'Jl. Kalibaru No. 45, Banyuwangi',
            'latitude' => -8.3480,
            'longitude' => 114.1550,
            'employee_count' => 12,
            'production_capacity' => 500.00,
            'monthly_energy_need' => 420.00,
            'current_energy_cost' => 2100000.00,
            'clean_energy_access' => false,
            'verification_status' => 'verified',
        ]);

        $biz2 = Business::create([
            'user_id' => $umkm2->id,
            'region_id' => $malang->id,
            'name' => 'Batik Surya',
            'sector' => 'Kerajinan',
            'description' => 'Produsen batik tulis khas Malang dengan motif modern dan tradisional.',
            'address' => 'Jl. Ijen No. 12, Malang',
            'latitude' => -7.9770,
            'longitude' => 112.6340,
            'employee_count' => 8,
            'production_capacity' => 200.00,
            'monthly_energy_need' => 280.00,
            'current_energy_cost' => 1400000.00,
            'clean_energy_access' => false,
            'verification_status' => 'verified',
        ]);

        $biz3 = Business::create([
            'user_id' => $umkm3->id,
            'region_id' => $kediri->id,
            'name' => 'Tahu Mandiri',
            'sector' => 'Pangan',
            'description' => 'Produsen tahu berkualitas tinggi dengan kapasitas produksi besar untuk distribusi regional.',
            'address' => 'Jl. Pare No. 78, Kediri',
            'latitude' => -7.8120,
            'longitude' => 112.0150,
            'employee_count' => 20,
            'production_capacity' => 1000.00,
            'monthly_energy_need' => 750.00,
            'current_energy_cost' => 3750000.00,
            'clean_energy_access' => false,
            'verification_status' => 'verified',
        ]);

        $biz4 = Business::create([
            'user_id' => $umkm4->id,
            'region_id' => $probolinggo->id,
            'name' => 'Ikan Asap Bahari',
            'sector' => 'Perikanan',
            'description' => 'Pengolahan ikan asap tradisional Probolinggo dengan proses modern dan higienis.',
            'address' => 'Jl. Pelabuhan No. 33, Probolinggo',
            'latitude' => -7.7560,
            'longitude' => 113.2170,
            'employee_count' => 15,
            'production_capacity' => 800.00,
            'monthly_energy_need' => 610.00,
            'current_energy_cost' => 3050000.00,
            'clean_energy_access' => false,
            'verification_status' => 'verified',
        ]);

        // ---- Energy Sources (SRS section 20.2) ----
        $es1 = EnergySource::create([
            'user_id' => $provider->id,
            'region_id' => $banyuwangi->id,
            'name' => 'Solar Hub Kalibaru',
            'type' => 'solar',
            'description' => 'Pembangkit listrik tenaga surya dengan panel berkapasitas tinggi di wilayah Kalibaru.',
            'address' => 'Jl. Raya Kalibaru KM 5, Banyuwangi',
            'latitude' => -8.3400,
            'longitude' => 114.1600,
            'total_capacity_kwh' => 1200.00,
            'available_capacity_kwh' => 1200.00,
            'status' => 'active',
        ]);

        $es2 = EnergySource::create([
            'user_id' => $provider->id,
            'region_id' => $malang->id,
            'name' => 'Micro Hydro Brantas',
            'type' => 'hydro',
            'description' => 'Pembangkit listrik mikro hidro yang memanfaatkan aliran Sungai Brantas.',
            'address' => 'Desa Tegalweru, Malang',
            'latitude' => -7.9800,
            'longitude' => 112.6400,
            'total_capacity_kwh' => 2000.00,
            'available_capacity_kwh' => 2000.00,
            'status' => 'active',
        ]);

        $es3 = EnergySource::create([
            'user_id' => $provider->id,
            'region_id' => $kediri->id,
            'name' => 'Biomass Agro Plant',
            'type' => 'biomass',
            'description' => 'Pembangkit listrik berbahan limbah pertanian dan perkebunan di wilayah Kediri.',
            'address' => 'Jl. Agro No. 10, Kediri',
            'latitude' => -7.8100,
            'longitude' => 112.0200,
            'total_capacity_kwh' => 1500.00,
            'available_capacity_kwh' => 1500.00,
            'status' => 'active',
        ]);

        // ---- Energy Needs ----
        EnergyNeed::create([
            'business_id' => $biz1->id,
            'period' => '2026-Q2',
            'monthly_need_kwh' => 420.00,
            'operating_hours_per_day' => 10,
            'main_equipment' => 'Mesin roasting, grinder, packaging',
            'current_energy_cost' => 2100000.00,
            'energy_problem' => 'Biaya listrik PLN tinggi, sering terjadi pemadaman',
            'validation_status' => 'validated',
        ]);

        EnergyNeed::create([
            'business_id' => $biz2->id,
            'period' => '2026-Q2',
            'monthly_need_kwh' => 280.00,
            'operating_hours_per_day' => 8,
            'main_equipment' => 'Kompor lilin, setrika, mesin cap',
            'current_energy_cost' => 1400000.00,
            'energy_problem' => 'Biaya energi cukup besar untuk skala usaha kecil',
            'validation_status' => 'validated',
        ]);

        EnergyNeed::create([
            'business_id' => $biz3->id,
            'period' => '2026-Q2',
            'monthly_need_kwh' => 750.00,
            'operating_hours_per_day' => 12,
            'main_equipment' => 'Mesin giling, pencetak, pengemas, boiler',
            'current_energy_cost' => 3750000.00,
            'energy_problem' => 'Biaya energi sangat tinggi, butuh sumber energi alternatif',
            'validation_status' => 'validated',
        ]);

        EnergyNeed::create([
            'business_id' => $biz4->id,
            'period' => '2026-Q2',
            'monthly_need_kwh' => 610.00,
            'operating_hours_per_day' => 10,
            'main_equipment' => 'Tungku asap, cold storage, packaging',
            'current_energy_cost' => 3050000.00,
            'energy_problem' => 'Penggunaan bahan bakar fosil untuk proses pengasapan',
            'validation_status' => 'validated',
        ]);

        // ---- Products (Marketplace demo) ----
        Product::create([
            'business_id' => $biz1->id,
            'name' => 'Kopi Arabika Kalibaru 250gr',
            'description' => 'Kopi arabika premium dari perkebunan Kalibaru, Banyuwangi. Roasting medium.',
            'category' => 'Minuman',
            'price' => 85000.00,
            'stock' => 100,
            'is_clean_energy_powered' => false,
            'status' => 'active',
        ]);

        Product::create([
            'business_id' => $biz2->id,
            'name' => 'Batik Tulis Motif Ijen',
            'description' => 'Batik tulis eksklusif dengan motif terinspirasi Kawah Ijen. Bahan katun premium.',
            'category' => 'Fashion',
            'price' => 350000.00,
            'stock' => 25,
            'is_clean_energy_powered' => false,
            'status' => 'active',
        ]);

        Product::create([
            'business_id' => $biz3->id,
            'name' => 'Tahu Putih Premium 1kg',
            'description' => 'Tahu putih berkualitas tinggi, produksi harian tanpa bahan pengawet.',
            'category' => 'Makanan',
            'price' => 25000.00,
            'stock' => 200,
            'is_clean_energy_powered' => false,
            'status' => 'active',
        ]);

        Product::create([
            'business_id' => $biz4->id,
            'name' => 'Ikan Asap Tongkol 500gr',
            'description' => 'Ikan asap tongkol tradisional Probolinggo, diasap dengan kayu pilihan.',
            'category' => 'Makanan',
            'price' => 45000.00,
            'stock' => 80,
            'is_clean_energy_powered' => false,
            'status' => 'active',
        ]);
    }
}
