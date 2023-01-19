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

        $addUserDetails = 'add-user_details';
        $editUserDetails = 'edit-user_details';
        $deleteUserDetails = 'delete-user_details';
        $viewUserDetails = 'view-user_details';

        $addInkubasi = 'add-inkubasi';
        $editInkubasi = 'edit-inkubasi';
        $deleteInkubasi = 'delete-inkubasi';
        $viewInkubasi = 'view-inkubasi';

        $addDaftarMentor = 'add-daftar_mentor';
        $editDaftarMentor = 'edit-daftar_mentor';
        $deleteDaftarMentor = 'delete-daftar_mentor';
        $viewDaftarMentor= 'view-daftar_mentor';

        $addFormPendaftaran = 'add-form-pendaftaran';
        $editFormPendaftaran = 'edit-form-pendaftaran';
        $deleteFormPendaftaran = 'delete-form-pendaftaran';
        $viewFormPendaftaran= 'view-form-pendaftaran';


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

        Permission::create(['name' => $addUserDetails]);
        Permission::create(['name' => $editUserDetails]);
        Permission::create(['name' => $deleteUserDetails]);
        Permission::create(['name' => $viewUserDetails]);

        Permission::create(['name' => $addInkubasi]);
        Permission::create(['name' => $editInkubasi]);
        Permission::create(['name' => $deleteInkubasi]);
        Permission::create(['name' => $viewInkubasi]);

        Permission::create(['name' => $addDaftarMentor]);
        Permission::create(['name' => $editDaftarMentor]);
        Permission::create(['name' => $deleteDaftarMentor]);
        Permission::create(['name' => $viewDaftarMentor]);

        Permission::create(['name' =>  $addFormPendaftaran]);
        Permission::create(['name' =>  $editFormPendaftaran]);
        Permission::create(['name' =>  $deleteFormPendaftaran]);
        Permission::create(['name' =>  $viewFormPendaftaran]);


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
                $addUserDetails, $editUserDetails, $deleteUserDetails, $viewUserDetails,
                $addInkubasi, $editInkubasi, $deleteInkubasi, $viewInkubasi,
                $addDaftarMentor, $editDaftarMentor, $deleteDaftarMentor, $viewDaftarMentor,
                $addFormPendaftaran, $editFormPendaftaran, $deleteFormPendaftaran, $viewFormPendaftaran,
            ]);
        Role::create(['name' => $tenant])
            ->givePermissionTo([
                $addTenantDetail, $editTenantDetail, $deleteTenantDetail, $viewTenantDetail,
                $addProposal, $editProposal, $deleteProposal, $viewProposal,
                $addMentoring, $editMentoring, $deleteMentoring, $viewMentoring,
                $addActivity, $editActivity, $deleteActivity, $viewActivity,
                $addFormPendaftaran, $viewFormPendaftaran,
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
