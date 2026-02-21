<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions grouped by module
        $permissions = [
            // Master Data
            'master.customers.view',
            'master.customers.create',
            'master.customers.update',
            'master.customers.delete',
            'master.suppliers.view',
            'master.suppliers.create',
            'master.suppliers.update',
            'master.suppliers.delete',
            'master.products.view',
            'master.products.create',
            'master.products.update',
            'master.products.delete',
            'master.warehouses.view',
            'master.warehouses.create',
            'master.warehouses.update',
            'master.warehouses.delete',
            'master.payment_terms.view',
            'master.payment_terms.create',
            'master.payment_terms.update',
            'master.payment_terms.delete',

            // Sales
            'sales.orders.view',
            'sales.orders.create',
            'sales.orders.approve',
            'sales.orders.cancel',
            'sales.delivery_orders.view',
            'sales.delivery_orders.create',
            'sales.invoices.view',
            'sales.invoices.create',
            'sales.invoices.post',

            // Purchasing
            'purchasing.orders.view',
            'purchasing.orders.create',
            'purchasing.orders.approve',
            'purchasing.orders.cancel',
            'purchasing.goods_receipts.view',
            'purchasing.goods_receipts.create',
            'purchasing.invoices.view',
            'purchasing.invoices.create',

            // Finance
            'finance.sales_payments.view',
            'finance.sales_payments.create',
            'finance.purchase_payments.view',
            'finance.purchase_payments.create',

            // Settings
            'settings.users.view',
            'settings.users.create',
            'settings.users.update',
            'settings.users.delete',
            'settings.roles.view',
            'settings.roles.create',
            'settings.roles.update',
            'settings.roles.delete',
        ];

        // Create all permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Admin role with ALL permissions
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions($permissions);

        // Create other roles
        $sales = Role::firstOrCreate(['name' => 'Sales']);
        $sales->syncPermissions([
            'master.customers.view', 'master.products.view',
            'sales.orders.view', 'sales.orders.create',
            'sales.delivery_orders.view', 'sales.delivery_orders.create',
            'sales.invoices.view',
        ]);

        $purchasing = Role::firstOrCreate(['name' => 'Purchasing']);
        $purchasing->syncPermissions([
            'master.suppliers.view', 'master.products.view',
            'purchasing.orders.view', 'purchasing.orders.create',
            'purchasing.goods_receipts.view', 'purchasing.goods_receipts.create',
            'purchasing.invoices.view',
        ]);

        $finance = Role::firstOrCreate(['name' => 'Finance']);
        $finance->syncPermissions([
            'sales.invoices.view', 'purchasing.invoices.view',
            'finance.sales_payments.view', 'finance.sales_payments.create',
            'finance.purchase_payments.view', 'finance.purchase_payments.create',
        ]);

        // Assign Admin role to user ID 1 (Kaesar Adam)
        $user = User::find(1);
        if ($user) {
            $user->assignRole('Admin');
        }

        $this->command->info('Roles & permissions seeded! User #1 assigned as Admin.');
    }
}
