<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierInvoiceCodeToStorageInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storage_invoices', function (Blueprint $table) {
            $table->string('supplier_invoice_code')->unique()->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storage_invoices', function (Blueprint $table) {
            $table->dropColumn('supplier_invoice_code');
        });
    }
}
