<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Designation;
use App\RegistrationType;
use App\Sign;
use App\AccountType;
use App\Group;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        Group::create(['name' => 'Client']);
        Group::create(['name' => 'Accountant']);
        Group::create(['name' => 'Data Center']);

        Role::create([
            'name' => strtolower('system admin'),
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => strtolower('admin'),
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => strtolower('user'),
            'guard_name' => 'web'
        ]);

        Designation::create(['name' => 'Chartered Professional Accountant (CPA)']);
        Designation::create(['name' => 'Certified Management Accountants (CMA)']);
        Designation::create(['name' => 'Bookkeeping']);

        RegistrationType::create(['name' => 'Sole proprietorship']);
        RegistrationType::create(['name' => 'Partnership']);
        RegistrationType::create(['name' => 'Corporation']);
        RegistrationType::create(['name' => 'Not-for-profit incorporation']);

        Sign::create(['name' => 'Debit']);
        Sign::create(['name' => 'Credit']);

        AccountType::create(['name' => 'Balance Sheet']);
        AccountType::create(['name' => 'Income Statement']);
        AccountType::create(['name' => 'Retained Earnings']);

        // create permissions
        /*Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);*/

        // create roles and assign existing permissions
        /*$role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');
        $role->givePermissionTo('delete articles');*/

        /*$role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('publish articles');
        $role->givePermissionTo('unpublish articles');*/
    }
}
