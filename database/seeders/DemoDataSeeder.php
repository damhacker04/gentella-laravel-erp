<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\PaymentTerm;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // === Admin user (jika belum ada) ===
        $admin = User::firstOrCreate(
        ['email' => 'admin@gentella.test'],
        ['name' => 'Administrator', 'password' => Hash::make('password')]
        );
        $admin->assignRole('Admin');

        // === Customers ===
        $customers = [
            ['code' => 'CUST-001', 'name' => 'PT Maju Bersama', 'email' => 'maju@example.com', 'phone' => '021-1234567', 'address' => 'Jl. Sudirman No. 10, Jakarta'],
            ['code' => 'CUST-002', 'name' => 'CV Sentosa Abadi', 'email' => 'sentosa@example.com', 'phone' => '031-7654321', 'address' => 'Jl. Diponegoro No. 5, Surabaya'],
            ['code' => 'CUST-003', 'name' => 'Toko Sejahtera', 'email' => 'sejahtera@example.com', 'phone' => '022-9876543', 'address' => 'Jl. Asia Afrika No. 3, Bandung'],
            ['code' => 'CUST-004', 'name' => 'PT Indo Makmur', 'email' => 'indomakmur@example.com', 'phone' => '024-1112233', 'address' => 'Jl. Pemuda No. 7, Semarang'],
            ['code' => 'CUST-005', 'name' => 'UD Karya Mandiri', 'email' => 'karya@example.com', 'phone' => '0341-556677', 'address' => 'Jl. Ijen No. 15, Malang'],
        ];
        foreach ($customers as $c) {
            Customer::firstOrCreate(['code' => $c['code']], $c);
        }

        // === Suppliers ===
        $suppliers = [
            ['code' => 'SUP-001', 'name' => 'PT Sumber Material', 'email' => 'sumber@example.com', 'phone' => '021-9998887', 'address' => 'Kawasan Industri Pulo Gadung, Jakarta'],
            ['code' => 'SUP-002', 'name' => 'CV Aneka Logam', 'email' => 'anekalogam@example.com', 'phone' => '031-4445556', 'address' => 'Jl. Rungkut Industri No. 12, Surabaya'],
            ['code' => 'SUP-003', 'name' => 'PT Global Supply', 'email' => 'global@example.com', 'phone' => '021-2223334', 'address' => 'Jl. Gatot Subroto Kav.7, Jakarta'],
        ];
        foreach ($suppliers as $s) {
            Supplier::firstOrCreate(['code' => $s['code']], $s);
        }

        // === Products ===
        $products = [
            ['sku' => 'PRD-001', 'name' => 'Besi Hollow 4x4', 'unit' => 'BTG', 'price' => 85000, 'stock_min' => 50, 'description' => 'Besi hollow ukuran 4x4 cm panjang 6 meter'],
            ['sku' => 'PRD-002', 'name' => 'Plat Besi 2mm', 'unit' => 'LBR', 'price' => 350000, 'stock_min' => 20, 'description' => 'Plat besi tebal 2mm ukuran 120x240 cm'],
            ['sku' => 'PRD-003', 'name' => 'Pipa Galvanis 1"', 'unit' => 'BTG', 'price' => 125000, 'stock_min' => 30, 'description' => 'Pipa galvanis diameter 1 inch, panjang 6m'],
            ['sku' => 'PRD-004', 'name' => 'Cat Besi Anti Karat', 'unit' => 'KLG', 'price' => 95000, 'stock_min' => 100, 'description' => 'Cat besi anti karat warna hitam 1 liter'],
            ['sku' => 'PRD-005', 'name' => 'Mur Baut M10', 'unit' => 'SET', 'price' => 5000, 'stock_min' => 500, 'description' => 'Mur baut stainless steel ukuran M10'],
            ['sku' => 'PRD-006', 'name' => 'Las Elektroda 2.6mm', 'unit' => 'DOS', 'price' => 75000, 'stock_min' => 50, 'description' => 'Elektroda las jenis E6013 2.6mm isi 5kg'],
            ['sku' => 'PRD-007', 'name' => 'Seng Gelombang', 'unit' => 'LBR', 'price' => 65000, 'stock_min' => 40, 'description' => 'Seng gelombang BJLS 0.2mm'],
            ['sku' => 'PRD-008', 'name' => 'Besi Siku 4x4', 'unit' => 'BTG', 'price' => 95000, 'stock_min' => 30, 'description' => 'Besi siku ukuran 4x4 cm panjang 6 meter'],
        ];
        foreach ($products as $p) {
            Product::firstOrCreate(['sku' => $p['sku']], $p);
        }

        // === Warehouses ===
        $warehouses = [
            ['code' => 'WH-001', 'name' => 'Gudang Utama', 'location' => 'Kawasan Industri Malang'],
            ['code' => 'WH-002', 'name' => 'Gudang Cabang Surabaya', 'location' => 'Jl. Rungkut Industri, Surabaya'],
        ];
        foreach ($warehouses as $w) {
            Warehouse::firstOrCreate(['code' => $w['code']], $w);
        }

        // === Payment Terms ===
        $terms = [
            ['code' => 'NET-0', 'name' => 'Tunai', 'days' => 0],
            ['code' => 'NET-7', 'name' => 'Net 7 Hari', 'days' => 7],
            ['code' => 'NET-14', 'name' => 'Net 14 Hari', 'days' => 14],
            ['code' => 'NET-30', 'name' => 'Net 30 Hari', 'days' => 30],
            ['code' => 'NET-60', 'name' => 'Net 60 Hari', 'days' => 60],
        ];
        foreach ($terms as $t) {
            PaymentTerm::firstOrCreate(['code' => $t['code']], $t);
        }

        $this->command->info('Demo data seeded successfully!');
    }
}
