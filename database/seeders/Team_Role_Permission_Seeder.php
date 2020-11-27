<?php

namespace Totaa\TotaaTeam\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Team_Role_Permission_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Permission::where("name", "view-team")->count() == 0) {
            $permission[] = Permission::create(['name' => 'view-team', "description" => "Xem Team", "group" => "Team", "order" => 1, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "view-team")->first();
        }

        if (Permission::where("name", "add-team")->count() == 0) {
            $permission[] = Permission::create(['name' => 'add-team', "description" => "Thêm Team", "group" => "Team", "order" => 2, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "add-team")->first();
        }

        if (Permission::where("name", "edit-team")->count() == 0) {
            $permission[] = Permission::create(['name' => 'edit-team', "description" => "Sửa Team", "group" => "Team", "order" => 3, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "edit-team")->first();
        }

        if (Permission::where("name", "delete-team")->count() == 0) {
            $permission[] = Permission::create(['name' => 'delete-team', "description" => "Xóa Team", "group" => "Team", "order" => 4, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "delete-team")->first();
        }

        if (Role::where("name", "super-admin")->count() == 0) {
            $super_admin =  Role::create(['name' => 'super-admin', "description" => "Super Admin", "group" => "Admin", "order" => 1, "lock" => true,]);
        } else {
            $super_admin= Role::where("name", "super-admin")->first();
        }

        if (Role::where("name", "admin")->count() == 0) {
            $admin = Role::create(['name' => 'admin', "description" => "Admin", "group" => "Admin", "order" => 2, "lock" => true,]);
        } else {
            $admin = Role::where("name", "admin")->first();
        }

        if (Role::where("name", "admin-team")->count() == 0) {
            $admin_team = Role::create(['name' => 'admin-team', "description" => "Admin quản lý Team", "group" => "Admin", "order" => 2, "lock" => true,]);
        } else {
            $admin_team = Role::where("name", "admin-team")->first();
        }

        $super_admin->syncPermissions($permission);
        $admin->syncPermissions($permission);
        $admin_team->syncPermissions($permission);
    }
}
