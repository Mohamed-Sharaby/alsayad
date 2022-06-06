<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UpdatePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Show Admins' => 'عرض المستخدمين',
            'Create Admins' => 'اضافة مستخدم ',
            'Edit Admins' => 'تعديل مستخدم',
            'Delete Admins' => 'حذف مستخدم',

            'Show Roles' => 'عرض المناصب',
            'Create Roles' => 'اضافة منصب',
            'Edit Roles' => 'تعديل منصب',
            'Delete Roles' => 'حذف منصب',

            'Show Clients' => 'عرض العملاء',
            'Create Clients' => 'اضافة عميل',
            'Edit Clients' => 'تعديل عميل',
            'Delete Clients' => 'حذف عميل',

            'Show Units' => 'عرض الوحدات',
            'Create Units' => 'اضافة وحدة',
            'Edit Units' => 'تعديل وحدة',
            'Delete Units' => 'حذف وحدة',

            'Show Materials' => 'عرض المواد الخام',
            'Create Materials' => 'اضافة مادة خام',
            'Edit Materials' => 'تعديل مادة خام',
            'Delete Materials' => 'حذف مادة خام',

            'Show Cooking' => 'عرض طرق الطبخ',
            'Create Cooking' => 'اضافة طريقة طبخ',
            'Edit Cooking' => 'تعديل طريقة طبخ',
            'Delete Cooking' => 'حذف طريقة طبخ',

            'Show Categories' => 'عرض الاقسام',
            'Create Categories' => 'اضافة قسم',
            'Edit Categories' => 'تعديل قسم',
            'Delete Categories' => 'حذف قسم',

            'Show Products' => 'عرض الاصناف',
            'Create Products' => 'اضافة صنف',
            'Edit Products' => 'تعديل صنف',
            'Delete Products' => 'حذف صنف',

            'Show StorageInvoices' => 'عرض فواتير الشراء',
            'Create StorageInvoices' => 'اضافة فاتورة شراء',
            'Edit StorageInvoices' => 'تعديل فاتورة شراء',
            'Delete StorageInvoices' => 'حذف فاتورة شراء',

            'Show Inventory' => 'عرض الجرد',
            'Create Inventory' => 'اضافة جرد',
            'Delete Inventory' => 'حذف جرد',

            'Show ExpensesItems' => 'عرض بنود المصاريف',
            'Create ExpensesItems' => 'اضافة بند مصاريف',
            'Edit ExpensesItems' => 'تعديل بند مصاريف',
            'Delete ExpensesItems' => 'حذف بند مصاريف',

            'Show Expenses' => 'عرض عمليات الصرف',
            'Create Expenses' => 'اضافة عملية صرف',
            'Edit Expenses' => 'تعديل عملية صرف',
            'Delete Expenses' => 'حذف عملية صرف',

            'Show Suppliers' => 'عرض الموردين',
            'Create Suppliers' => 'اضافة مورد',
            'Edit Suppliers' => 'تعديل مورد',
            'Delete Suppliers' => 'حذف مورد',

            'Show RestaurantInvoices' => 'عرض اذونات الصرف',
            'Create RestaurantInvoices' => 'اضافة اذن صرف',
            'Edit RestaurantInvoices' => 'تعديل اذن صرف',
            'Delete RestaurantInvoices' => 'حذف اذن صرف',

            'Show SalesInvoices' => 'عرض فواتير البيع',
            'Create SalesInvoices' => 'اضافة فاتورة بيع',
            'Edit SalesInvoices' => 'تعديل فاتورة بيع',
            //'Delete SalesInvoices' => 'حذف فاتورة بيع',

            'Show Salaries' => 'عرض عمليات المرتبات',
            'Create Salaries' => 'اضافة عملية مرتب',
            'Edit Salaries' => 'تعديل عملية مرتب',
            'Delete Salaries' => 'حذف عملية مرتب',

            'Show Settings' => 'التحكم فى الاعدادات',
        ];

        foreach ($permissions as $key => $permission) {
            Permission::where('name', $key)->update(['ar_name' => $permission]);
        }
    }
}
