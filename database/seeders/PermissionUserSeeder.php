<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'users', 'web', 'المستخدمين', 'Users', '1', '1', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'view_users', 'web', 'عرض', 'View', NULL, '1', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_users', 'web', 'إضافة', 'Add', NULL, '1', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_users', 'web', 'تعديل', 'Update', NULL, '1', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_users', 'web', 'حذف', 'Delete', NULL, '1', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'change_password_user', 'web', 'تغيير كلمة المرور', 'Change Password', NULL, '1', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'change_status_users', 'web', 'تغيير الحالة', 'Change Status', NULL, '1', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'permission_users', 'web', 'الصلاحيات', 'Permission', NULL, '1', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'setting', 'web', 'الإعدادات', 'Setting', '1', '2', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_setting', 'web', 'تعديل', 'Update', NULL, '2', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'product_packages', 'web', 'باقات المنتجات', 'product_packages', '1', '3', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'products', 'web', 'المنتجات', 'Products', '1', '3', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_products', 'web', 'إضافة', 'Add', NULL, '3', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_products', 'web', 'تعديل', 'Edit', NULL, '3', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_products', 'web', 'حذف', 'Delete', NULL, '3', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'api_setting', 'web', 'Api Setting', 'Api Setting', '1', '6', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_api_setting', 'web', 'تعديل', 'Update', NULL, '6', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'versions', 'web', 'الإصدارات', 'Versions', '1', '4', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_versions', 'web', 'إضافة', 'Add', NULL, '4', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_versions', 'web', 'تعديل', 'Update', NULL, '4', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_versions', 'web', 'حذف', 'Delete', NULL, '4', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'status_version', 'web', 'تغيير الحالة', 'Change Status', NULL, '4', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'download_files', 'web', 'تنزيل الملفات', 'Download Files', NULL, '4', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'clients', 'web', 'العملاء', 'Clients', '1', '5', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_clients', 'web', 'إضافة', 'Add', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_clients', 'web', 'تعديل', 'Update', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'notifications', 'web', 'الإشعارات', 'Notifications', '1', '7', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_notifications', 'web', 'إضافة', 'Add', NULL, '7', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_notifications', 'web', 'تعديل', 'Update', NULL, '7', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_notifications', 'web', 'حذف', 'Delete', NULL, '7', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'licenses', 'web', 'التراخيص', 'Licenses', '1', '8', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_licenses', 'web', 'إضافة', 'Add', NULL, '8', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_licenses', 'web', 'تعديل', 'Update', NULL, '8', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_licenses', 'web', 'حذف', 'Delete', NULL, '8', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'send_mail_licenses', 'web', 'إرسال بريد الكتروني', 'Send Mail', NULL, '8', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'show_client_profile', 'web', 'عرض ملف الشركة ', 'show client profile', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'download_licenses', 'web', NULL, 'Download Licenses', NULL, '8', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'block_licenses', 'web', NULL, 'Block Licenses', NULL, '8', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'activations', 'web', 'Activations', 'Activations', '1', '9', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'activity_logs', 'web', 'تسجيلات النظام', 'activity logs', NULL, '9', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_activity_log', 'web', 'حذف تسجيلات النظام ', 'delete activity logs', NULL, '9', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_activations', 'web', 'Delete', 'Delete', NULL, '9', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'api_calls', 'web', 'Api Calls', 'Api Calls', '1', '10', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_api_calls', 'web', 'Delete', 'Delete', NULL, '10', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'downloads', 'web', 'Downloads', 'Downloads', '1', '11', NULL, NULL)");
        \DB::Insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_downloads', 'web', 'Delete', 'Delete', NULL, '11', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'roles', 'web', 'Roles', 'Roles', '1', '12', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_roles', 'web', 'Add', 'Add', NULL, '12', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_roles', 'web', 'Update', 'Update', NULL, '12', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_roles', 'web', 'Delete', 'Delete', NULL, '12', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'permission_roles', 'web', 'Permission', 'Permission', NULL, '12', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'cities', 'web', 'Roles', 'Cities', '1', '13', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_cities', 'web', 'Add', 'Add', NULL, '13', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_cities', 'web', 'Update', 'Update', NULL, '13', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'countries', 'web', 'Countries', 'Countries', '1', '14', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_status_countries', 'web', 'Update Status', 'Update Status', NULL, '14', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_status_cities', 'web', 'Update Status', 'Update Status', NULL, '13', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'email_setings', 'web', 'Email Setting', 'Email Setting', '1', '16', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_email_setings', 'web', 'Update', 'Update', NULL, '16', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'get_api_key', 'web', 'Api Key', 'Api Key', '1', '17', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_api_key', 'web', 'Add', 'Add', NULL, '17', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_api_key', 'web', 'Delete', 'Delete', NULL, '17', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'client_statistics', 'web', 'Statistics', 'Statistics', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'edit_client', 'web', 'Edit', 'Edit', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_client_user', 'web', 'Add User', 'Add User', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'edit_client_user', 'web', 'Edit User', 'Edit User', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'change_status_client_user', 'web', 'Change Status User', 'Change Status User', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'client_user', 'web', 'Client User', 'Client User', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_client_user', 'web', 'Delete User', 'Delete User', NULL, '5', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'statistics', 'web', 'Dashboard Statistics', 'Dashboard Statistics', '1', '18', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'packages', 'web', 'Packages', 'Packages', '1', '19', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_packages', 'web', 'Add', 'Add', NULL, '19', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'edit_packages', 'web', 'Edit', 'Edit', NULL, '19', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_packages', 'web', 'Delete', 'Delete', NULL, '19', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'update_status_packages', 'web', 'Update Status', 'Update Status', NULL, '19', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_cities', 'web', 'Delete', 'Delete', NULL, '13', NULL, NULL)");
        \DB::Insert("INSERT INTO `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_clients', 'web', 'Delete Company', 'Delete Company', NULL, '5', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'static_page', 'web', 'الصفحات الثابتة', 'Static Page', '1', '20', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'edit_page', 'web', 'تعديل', 'Edit', NULL, '20', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'delete_page', 'web', 'حذف', 'Delete', NULL, '20', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'add_page', 'web', 'إضافة', 'Add', NULL, '20', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'view_page', 'web', 'عرض', 'View', NULL, '20', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (NULL, 'status_page', 'web', 'تغيير الحالة', 'Status Page', NULL, '20', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (null, 'renewal_team', 'web', 'Renewal Team', 'Renewal Team', '1', '21', NULL, NULL)");
        \DB::insert("INSERT INTO  `permissions` (`id`, `name`, `guard_name`, `name_ar`, `name_en`, `group`, `group_id`, `created_at`, `updated_at`) VALUES (null, 'ticket_reply', 'web', 'Ticket', 'Ticket', '1', '22', NULL, NULL)");
        Schema::enableForeignKeyConstraints();
    }
}
