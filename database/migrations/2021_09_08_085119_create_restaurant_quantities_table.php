<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared("create view restaurant_quantities as SELECT
        SII.product_id ,
        sum(SII.quantity) quantity,
        s.quantity sales,
        sum(SII.quantity) -  s.quantity  remaining

    FROM
    storage_invoice_items SII
        INNER JOIN
    storage_invoices ON SII.storage_invoice_id = storage_invoices.id
        LEFT JOIN
    (SELECT
        product_id, SUM(quantity) quantity
    FROM
        sale_items
    GROUP BY product_id) s ON s.product_id = SII.product_id

    where storage_invoices.type='out'
    group by SII.product_id
");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_quantities');
    }
}
