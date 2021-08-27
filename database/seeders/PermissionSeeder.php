<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
		            [
		            'name' => 'Xem dự án',
		            'module' => 'project',
		            'slug' => 'view-project',
		            'action' => 'view',
		            'is_status' => 1,
		        ],[
		            'name' => 'Tạo dự án',
		            'module' => 'project',
		            'slug' => 'create-project',
		            'action' => 'create',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa dự án',
		            'module' => 'project',
		            'slug' => 'update-project',
		            'action' => 'update',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa dự án dev',
		            'module' => 'project',
		            'slug' => 'update-dev-project',
		            'action' => 'update-dev',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa dự án sale',
		            'module' => 'project',
		            'slug' => 'update-sale-project',
		            'action' => 'update-sale',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xoá dự án',
		            'module' => 'project',
		            'slug' => 'delete-project',
		            'action' => 'delete',
		            'is_status' => 1,
		        ],[
		            'name' => 'Gửi mail dự án',
		            'module' => 'project',
		            'slug' => 'send-mail-project',
		            'action' => 'send-mail',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xem nhóm trạng thái',
		            'module' => 'group_status',
		            'slug' => 'view-group_status',
		            'action' => 'view',
		            'is_status' => 1,
		        ],[
		            'name' => 'Tạo nhóm trạng thái',
		            'module' => 'group_status',
		            'slug' => 'create-group_status',
		            'action' => 'create',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa nhóm trạng thái',
		            'module' => 'group_status',
		            'slug' => 'update-group_status',
		            'action' => 'update',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xoá nhóm trạng thái',
		            'module' => 'group_status',
		            'slug' => 'delete-group_status',
		            'action' => 'delete',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xem trạng thái',
		            'module' => 'status',
		            'slug' => 'view-status',
		            'action' => 'view',
		            'is_status' => 1,
		        ],[
		            'name' => 'Tạo trạng thái',
		            'module' => 'status',
		            'slug' => 'create-status',
		            'action' => 'create',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa trạng thái',
		            'module' => 'status',
		            'slug' => 'update-status',
		            'action' => 'update',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xoá trạng thái',
		            'module' => 'status',
		            'slug' => 'delete-status',
		            'action' => 'delete',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xem quyền',
		            'module' => 'permission',
		            'slug' => 'view-permission',
		            'action' => 'view',
		            'is_status' => 1,
		        ],[
		            'name' => 'Tạo quyền',
		            'module' => 'permission',
		            'slug' => 'create-permission',
		            'action' => 'create',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa quyền',
		            'module' => 'permission',
		            'slug' => 'update-permission',
		            'action' => 'update',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xoá quyền',
		            'module' => 'permission',
		            'slug' => 'delete-permission',
		            'action' => 'delete',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xem vai trò',
		            'module' => 'role',
		            'slug' => 'view-role',
		            'action' => 'view',
		            'is_status' => 1,
		        ],[
		            'name' => 'Tạo vai trò',
		            'module' => 'role',
		            'slug' => 'create-role',
		            'action' => 'create',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa vai trò',
		            'module' => 'role',
		            'slug' => 'update-role',
		            'action' => 'update',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xoá vai trò',
		            'module' => 'role',
		            'slug' => 'delete-role',
		            'action' => 'delete',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xem nhóm thành viên',
		            'module' => 'group_member',
		            'slug' => 'view-group_member',
		            'action' => 'view',
		            'is_status' => 1,
		        ],[
		            'name' => 'Tạo nhóm thành viên',
		            'module' => 'group_member',
		            'slug' => 'create-group_member',
		            'action' => 'create',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa nhóm thành viên',
		            'module' => 'group_member',
		            'slug' => 'update-group_member',
		            'action' => 'update',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xoá nhóm thành viên',
		            'module' => 'group_member',
		            'slug' => 'delete-group_member',
		            'action' => 'delete',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xem thành viên',
		            'module' => 'member',
		            'slug' => 'view-member',
		            'action' => 'view',
		            'is_status' => 1,
		        ],[
		            'name' => 'Tạo thành viên',
		            'module' => 'member',
		            'slug' => 'create-member',
		            'action' => 'create',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa thành viên',
		            'module' => 'member',
		            'slug' => 'update-member',
		            'action' => 'update',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xoá thành viên',
		            'module' => 'member',
		            'slug' => 'delete-member',
		            'action' => 'delete',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xem người dùng',
		            'module' => 'user',
		            'slug' => 'view-user',
		            'action' => 'view',
		            'is_status' => 1,
		        ],[
		            'name' => 'Tạo người dùng',
		            'module' => 'user',
		            'slug' => 'create-user',
		            'action' => 'create',
		            'is_status' => 1,
		        ],[
		            'name' => 'Sửa người dùng',
		            'module' => 'user',
		            'slug' => 'update-user',
		            'action' => 'update',
		            'is_status' => 1,
		        ],[
		            'name' => 'Xoá người dùng',
		            'module' => 'user',
		            'slug' => 'delete-user',
		            'action' => 'delete',
		            'is_status' => 1,
		        ],
        ];
        foreach($data as $v) {
            Permission::create($v);
        }
    }
}
