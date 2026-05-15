<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Roles and permissions from SRS section 4.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions based on SRS section 4.2
        $permissions = [
            // User management
            'manage-users',
            'view-users',

            // UMKM / Business
            'create-business',
            'edit-own-business',
            'edit-any-business',
            'view-any-business',
            'delete-own-business',
            'delete-any-business',
            'validate-business',

            // Energy Sources
            'create-energy-source',
            'edit-own-energy-source',
            'edit-any-energy-source',
            'view-any-energy-source',
            'delete-any-energy-source',

            // Energy Needs
            'create-energy-need',
            'edit-own-energy-need',
            'view-any-energy-need',
            'validate-energy-need',

            // Map
            'view-energy-map',

            // Recommendations
            'generate-recommendation',
            'view-any-recommendation',
            'view-own-recommendation',
            'validate-recommendation',

            // Distribution
            'create-distribution',
            'edit-distribution',
            'view-any-distribution',
            'view-own-distribution',

            // Products
            'create-product',
            'edit-own-product',
            'delete-own-product',
            'view-any-product',
            'validate-product',

            // Partnerships
            'create-partnership',
            'view-own-partnership',
            'view-any-partnership',
            'manage-partnership',

            // Reports
            'view-impact-report',
            'view-own-impact-report',
            'export-report',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions per SRS section 4.1 & 4.2
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        $umkmRole = Role::firstOrCreate(['name' => 'umkm', 'guard_name' => 'web']);
        $umkmRole->givePermissionTo([
            'create-business', 'edit-own-business', 'delete-own-business',
            'create-energy-need', 'edit-own-energy-need',
            'view-energy-map',
            'view-own-recommendation',
            'view-own-distribution',
            'create-product', 'edit-own-product', 'delete-own-product',
            'create-partnership', 'view-own-partnership',
            'view-own-impact-report',
        ]);

        $governmentRole = Role::firstOrCreate(['name' => 'government', 'guard_name' => 'web']);
        $governmentRole->givePermissionTo([
            'view-any-business',
            'view-any-energy-source',
            'view-any-energy-need',
            'view-energy-map',
            'generate-recommendation', 'view-any-recommendation', 'validate-recommendation',
            'view-any-distribution',
            'view-impact-report',
            'export-report',
            'view-any-partnership',
        ]);

        $providerRole = Role::firstOrCreate(['name' => 'provider', 'guard_name' => 'web']);
        $providerRole->givePermissionTo([
            'create-energy-source', 'edit-own-energy-source',
            'view-any-business',
            'view-any-energy-need',
            'view-energy-map',
            'generate-recommendation', 'view-any-recommendation',
            'create-distribution', 'edit-distribution', 'view-any-distribution',
            'create-partnership', 'view-own-partnership',
            'view-impact-report',
            'export-report',
        ]);

        $partnerRole = Role::firstOrCreate(['name' => 'partner', 'guard_name' => 'web']);
        $partnerRole->givePermissionTo([
            'view-any-business',
            'view-any-energy-source',
            'view-energy-map',
            'view-any-product',
            'create-partnership', 'view-own-partnership',
        ]);
    }
}
