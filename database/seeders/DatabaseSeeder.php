<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\EnergySource;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ============================================================
        // Users - Setiap role memiliki akun demo
        // ============================================================

        $admin = User::create([
            'name' => 'Admin EnergEco',
            'email' => 'admin@energeco.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'status' => 'active',
        ]);

        $government = User::create([
            'name' => 'Dinas ESDM Kab. Malang',
            'email' => 'pemerintah@energeco.id',
            'password' => Hash::make('password'),
            'role' => 'government',
            'phone' => '081234567891',
            'status' => 'active',
        ]);

        $provider1 = User::create([
            'name' => 'PT Solar Nusantara',
            'email' => 'solar@energeco.id',
            'password' => Hash::make('password'),
            'role' => 'energy_provider',
            'phone' => '081234567892',
            'status' => 'active',
        ]);

        $provider2 = User::create([
            'name' => 'CV Biomassa Agro Mandiri',
            'email' => 'biomassa@energeco.id',
            'password' => Hash::make('password'),
            'role' => 'energy_provider',
            'phone' => '081234567893',
            'status' => 'active',
        ]);

        $umkm1User = User::create([
            'name' => 'Pak Budi - Keripik Pisang',
            'email' => 'umkm1@energeco.id',
            'password' => Hash::make('password'),
            'role' => 'business_owner',
            'phone' => '081234567894',
            'status' => 'active',
        ]);

        $umkm2User = User::create([
            'name' => 'Bu Sari - Cold Storage Ikan',
            'email' => 'umkm2@energeco.id',
            'password' => Hash::make('password'),
            'role' => 'business_owner',
            'phone' => '081234567895',
            'status' => 'active',
        ]);

        $umkm3User = User::create([
            'name' => 'Pak Joko - Pengeringan Kopi',
            'email' => 'umkm3@energeco.id',
            'password' => Hash::make('password'),
            'role' => 'business_owner',
            'phone' => '081234567896',
            'status' => 'active',
        ]);

        $investor = User::create([
            'name' => 'PT Investasi Hijau Indonesia',
            'email' => 'investor@energeco.id',
            'password' => Hash::make('password'),
            'role' => 'investor',
            'phone' => '081234567897',
            'status' => 'active',
        ]);

        // ============================================================
        // Energy Sources - Sumber energi bersih
        // ============================================================

        EnergySource::create([
            'provider_id' => $provider1->id,
            'name' => 'PLTS Desa Sumber Makmur',
            'type' => 'solar',
            'description' => 'Pembangkit listrik tenaga surya komunitas desa dengan kapasitas 5000 kWh.',
            'address' => 'Desa Sumber Makmur',
            'city' => 'Kabupaten Malang',
            'province' => 'Jawa Timur',
            'latitude' => -8.0500000,
            'longitude' => 112.6300000,
            'capacity_kwh' => 5000,
            'available_kwh' => 2500,
            'cost_per_kwh' => 800,
            'status' => 'active',
        ]);

        EnergySource::create([
            'provider_id' => $provider2->id,
            'name' => 'Biomassa Agro Mandiri',
            'type' => 'biomass',
            'description' => 'Pembangkit listrik biomassa dari limbah pertanian.',
            'address' => 'Desa Agro Mandiri',
            'city' => 'Kabupaten Malang',
            'province' => 'Jawa Timur',
            'latitude' => -8.0800000,
            'longitude' => 112.6500000,
            'capacity_kwh' => 3000,
            'available_kwh' => 1200,
            'cost_per_kwh' => 650,
            'status' => 'active',
        ]);

        EnergySource::create([
            'provider_id' => $provider1->id,
            'name' => 'Mikrohidro Kali Sejahtera',
            'type' => 'hydro',
            'description' => 'Pembangkit listrik mikrohidro memanfaatkan aliran sungai.',
            'address' => 'Desa Kali Sejahtera',
            'city' => 'Kabupaten Malang',
            'province' => 'Jawa Timur',
            'latitude' => -8.1000000,
            'longitude' => 112.6800000,
            'capacity_kwh' => 4000,
            'available_kwh' => 1800,
            'cost_per_kwh' => 720,
            'status' => 'active',
        ]);

        // ============================================================
        // Businesses (UMKM) - Data dummy dari planning
        // ============================================================

        Business::create([
            'user_id' => $umkm1User->id,
            'name' => 'UMKM Pengolahan Keripik Pisang',
            'sector' => 'food_processing',
            'description' => 'Usaha pengolahan keripik pisang dengan berbagai rasa.',
            'address' => 'Jl. Industri No. 12',
            'city' => 'Kabupaten Malang',
            'province' => 'Jawa Timur',
            'latitude' => -8.0550000,
            'longitude' => 112.6350000,
            'monthly_energy_need' => 900,
            'current_energy_cost' => 2500000,
            'production_capacity' => 500,
            'employee_count' => 12,
            'clean_energy_access' => false,
            'status' => 'active',
        ]);

        Business::create([
            'user_id' => $umkm2User->id,
            'name' => 'UMKM Cold Storage Ikan',
            'sector' => 'fisheries',
            'description' => 'Penyimpanan dan distribusi ikan segar dengan cold storage.',
            'address' => 'Jl. Nelayan No. 5',
            'city' => 'Kabupaten Malang',
            'province' => 'Jawa Timur',
            'latitude' => -8.0700000,
            'longitude' => 112.6400000,
            'monthly_energy_need' => 1500,
            'current_energy_cost' => 4200000,
            'production_capacity' => 1000,
            'employee_count' => 20,
            'clean_energy_access' => false,
            'status' => 'active',
        ]);

        Business::create([
            'user_id' => $umkm3User->id,
            'name' => 'UMKM Pengeringan Kopi',
            'sector' => 'agriculture',
            'description' => 'Proses pengeringan dan pengolahan biji kopi lokal.',
            'address' => 'Jl. Perkebunan No. 8',
            'city' => 'Kabupaten Malang',
            'province' => 'Jawa Timur',
            'latitude' => -8.0900000,
            'longitude' => 112.6700000,
            'monthly_energy_need' => 1100,
            'current_energy_cost' => 3000000,
            'production_capacity' => 300,
            'employee_count' => 15,
            'clean_energy_access' => false,
            'status' => 'active',
        ]);
    }
}
