<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Permission List
        $addUser = 'add-user';
        $editUser = 'edit-user';
        $deleteUser = 'delete-user';
        $viewUser = 'view-user';
        $approveUser = 'aprrove-user';
        $suspendUser = 'suspend-user';

        $addRole = 'add-role';
        $editRole = 'edit-role';
        $deleteRole = 'delete-role';
        $viewRole = 'view-role';

        $addPermission = 'add-permission';
        $editPermission = 'edit-permission';
        $deletePermission = 'delete-permission';
        $viewPermission = 'view-permission';

        $addTenantDetail = 'add-tenant-detail';
        $editTenantDetail = 'edit-tenant-detail';
        $deleteTenantDetail = 'delete-tenant-detail';
        $viewTenantDetail = 'view-tenant-detail';

        $addProposal = 'add-proposal';
        $editProposal = 'edit-proposal';
        $deleteProposal = 'delete-proposal';
        $viewProposal = 'view-proposal';
        $approveProposal = 'approve-proposal';
        $rejectProposal = 'reject-proposal';

        $addMentoring = 'add-mentoring';
        $editMentoring = 'edit-mentoring';
        $deleteMentoring = 'delete-mentoring';
        $viewMentoring = 'view-mentoring';

        $addActivity = 'add-activity';
        $editActivity = 'edit-activity';
        $deleteActivity = 'delete-activity';
        $viewActivity = 'view-activity';

        // create permissions
        Permission::create(['name' => $addUser]);
        Permission::create(['name' => $editUser]);
        Permission::create(['name' => $deleteUser]);
        Permission::create(['name' => $viewUser]);
        Permission::create(['name' => $approveUser]);
        Permission::create(['name' => $suspendUser]);

        Permission::create(['name' => $addRole]);
        Permission::create(['name' => $editRole]);
        Permission::create(['name' => $deleteRole]);
        Permission::create(['name' => $viewRole]);

        Permission::create(['name' => $addPermission]);
        Permission::create(['name' => $editPermission]);
        Permission::create(['name' => $deletePermission]);
        Permission::create(['name' => $viewPermission]);

        Permission::create(['name' => $addTenantDetail]);
        Permission::create(['name' => $editTenantDetail]);
        Permission::create(['name' => $deleteTenantDetail]);
        Permission::create(['name' => $viewTenantDetail]);

        Permission::create(['name' => $addProposal]);
        Permission::create(['name' => $editProposal]);
        Permission::create(['name' => $deleteProposal]);
        Permission::create(['name' => $viewProposal]);
        Permission::create(['name' => $approveProposal]);
        Permission::create(['name' => $rejectProposal]);

        Permission::create(['name' => $addMentoring]);
        Permission::create(['name' => $editMentoring]);
        Permission::create(['name' => $deleteMentoring]);
        Permission::create(['name' => $viewMentoring]);

        Permission::create(['name' => $addActivity]);
        Permission::create(['name' => $editActivity]);
        Permission::create(['name' => $deleteActivity]);
        Permission::create(['name' => $viewActivity]);

    
        //Roles List
        $superAdmin = 'super-admin';
        $admin = 'admin';
        $tenant = 'tenant';
        $juri = 'juri';
        $mentor = 'mentor';
        $talent= 'talent';

        Role::create(['name' => $superAdmin])
            ->givePermissionTo([Permission::all()]);
        Role::create(['name' => $admin])
            ->givePermissionTo([
                $addUser, $editUser, $deleteUser, $viewUser, $approveUser, $suspendUser,
                $addRole, $editRole, $deleteRole, $viewRole,
                $addPermission, $editPermission, $deletePermission, $viewPermission,
                $addTenantDetail, $editTenantDetail, $deleteTenantDetail, $viewTenantDetail,
                $addProposal, $editProposal, $deleteProposal, $viewProposal, $approveProposal, $rejectProposal,
                $addMentoring, $editMentoring, $deleteMentoring, $viewMentoring,
                $addActivity, $editActivity, $deleteActivity, $viewActivity,
            ]);
        Role::create(['name' => $tenant])
            ->givePermissionTo([
                $addTenantDetail, $editTenantDetail, $deleteTenantDetail, $viewTenantDetail,
                $addProposal, $editProposal, $deleteProposal, $viewProposal,
                $addMentoring, $editMentoring, $deleteMentoring, $viewMentoring,
                $addActivity, $editActivity, $deleteActivity, $viewActivity,
            ]);
        Role::create(['name' => $juri])
            ->givePermissionTo([
                $viewProposal, $approveProposal, $rejectProposal,
            ]);
        Role::create(['name' => $mentor])
            ->givePermissionTo([
                $addMentoring, $editMentoring, $deleteMentoring, $viewMentoring,
            ]);
        
        Role::create(['name' => $talent])
            ->givePermissionTo([
                $addProposal, $editProposal, $deleteProposal, $viewProposal,
                $addMentoring, $editMentoring, $deleteMentoring, $viewMentoring,
                $addActivity, $editActivity, $deleteActivity, $viewActivity,
            ]);
    }
}
