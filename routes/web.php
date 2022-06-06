<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'bill.', 'prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::resource('categories', \App\Http\Controllers\Api\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Api\ProductController::class);
    Route::resource('clients', \App\Http\Controllers\Api\ClientController::class);

    Route::get('admin-id', [\App\Http\Controllers\Api\BillController::class, 'admin_id']);
    Route::get('cooking-types', [\App\Http\Controllers\Api\BillController::class, 'cooking_types']);
    Route::get('settings', [\App\Http\Controllers\Api\BillController::class, 'settings']);
    Route::post('save-invoice', [\App\Http\Controllers\Api\BillController::class, 'save_invoice']);
});

Route::group(['middleware' => ['auth', 'admin'], 'as' => 'admin.'], function () {
    Route::get('suppliers/products', SupplierProductsController::class)->name('suppliers.products');
    Route::get('/', [DashboardController::class, 'index'])->name('main');
    Route::resources([
        'roles' => RoleController::class,
        'admins' => AdminController::class,
        'clients' => ClientController::class,
        'units' => UnitController::class,
        'cookings' => CookingController::class,
        'categories' => CategoryController::class,
        'expense-items' => ExpenseItemController::class,
        'expenses' => ExpenseController::class,
        'products' => ProductController::class,
        'materials' => MaterialController::class,
        'suppliers' => SupplierController::class,
        'storage-invoices' => StorageInvoiceController::class,
        'restaurant-invoices' => RestaurantInvoiceController::class,
        'inventories' => InventoryController::class,
        'payrolls' => PayrollController::class,
        'settings' => SettingController::class,
        'sales' => SaleController::class,
        'shifts' => ShiftController::class,
        'cashiers' => CashierController::class,
        'receiving' => ReceivingController::class,
    ]);

    Route::get('products/{id}/made', [MadeProductController::class, 'getMadeView'])->name('products.getMadeView');
    Route::put('products/{id}/made', [MadeProductController::class, 'madeProduct'])->name('products.madeProduct');

    Route::get('storage-invoice/paid/{id}', [InvoicePaidController::class, 'getPaidView'])->name('getPaidView');
    Route::put('storage-invoice/paid/{id}', [InvoicePaidController::class, 'paidInvoice'])->name('paidInvoice');

    Route::get('sales-invoice/paid/{id}', [InvoicePaidController::class, 'getSalesPaidView'])->name('getSalesPaidView');
    Route::put('sales-invoice/paid/{id}', [InvoicePaidController::class, 'paidSalesInvoice'])->name('paidSalesInvoice');

    Route::get('client-sales/{client}', ClientSaleController::class)->name('client.sales');

    Route::post('active/{id}/role', [RoleController::class, 'active'])->name('active.role');
    Route::post('active/{id}/{type}', [DashboardController::class, 'active'])->name('active');

    Route::get('sales-report', [ReportController::class, 'getSalesReport'])->name('getSalesReport');
    Route::get('expenses-report', [ReportController::class, 'getExpensesReport'])->name('getExpensesReport');
    Route::get('tax-report', [ReportController::class, 'getTaxReport'])->name('getTaxReport');
    Route::get('sold-products-report', [ReportController::class, 'getSoldProductsReport'])->name('getSoldProductsReport');
    Route::get('daily-report', [ReportController::class, 'getDailyReport'])->name('getDailyReport');
    Route::get('client-report', [ReportController::class, 'getClientReport'])->name('getClientReport');

    Route::get('get/adds', [PayrollController::class, 'getAdds']);

});

Route::get('/invoice/{uuid}/print-invoice', [SaleController::class, 'print'])->name('printInvoice');

require __DIR__ . '/auth.php';

