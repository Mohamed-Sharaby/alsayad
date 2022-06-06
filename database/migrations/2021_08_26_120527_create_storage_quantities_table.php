<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create view storage_quantities as SELECT
    product_id,
    SUM(
        IF(
            storage_invoices.type = 'in',
            quantity,
            (quantity * -1)
            )
        ) as quantity,
       SUBSTRING_INDEX( GROUP_CONCAT(buying_price  ORDER BY storage_invoice_items.created_at DESC), ',', 1 ) AS buying_price

    FROM
        `storage_invoice_items`
    INNER JOIN storage_invoices ON storage_invoices.id = storage_invoice_items.storage_invoice_id
    GROUP BY
        product_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storage_quantities');
    }
}
