<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Settings
            'settings.view' => 'View site settings',
            'settings.edit' => 'Edit site settings',
            'settings.scripts' => 'Manage tracking/scripts (admin only)',

            // IP Block
            'ipblock.view' => 'View blocked IPs',
            'ipblock.manage' => 'Manage blocked IPs',

            // Reports
            'report.view' => 'View reports',
            'report.export' => 'Export reports',

            // Payments
            'payment.manage' => 'Manage order payments',

            // Landing Pages
            'landing.view' => 'View landing pages',
            'landing.manage' => 'Manage landing pages',

            // About Us
            'about_us.view' => 'View About Us page',
            'about_us.edit' => 'Edit About Us page',
        ];

        foreach ($permissions as $name => $description) {
            Permission::firstOrCreate([
                'name' => $name,
                'guard_name' => 'web',
            ]);
        }

        // Assign all new permissions to admin role
        $admin = Role::where('name', 'admin')->first();
        if ($admin) {
            $admin->givePermissionTo(array_keys($permissions));
        }

        // Assign report.view to worker role
        $worker = Role::where('name', 'worker')->first();
        if ($worker) {
            $worker->givePermissionTo(['report.view']);
        }
    }
}