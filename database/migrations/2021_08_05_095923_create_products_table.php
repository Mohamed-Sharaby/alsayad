<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->enum('type', ["material","ready","made"]);
            $table->boolean('made_in_order')->default(0);
            $table->string('image')->nullable();
            $table->decimal('selling_price', 8, 4)->nullable();
            $table->decimal('buying_price', 8, 4)->nullable();
            $table->decimal('made_cost', 8, 4)->nullable();
            $table->integer('start_quantity')->nullable();
            $table->boolean('is_active')->index()->default(1);
            $table->foreignId('created_by')->nullable()->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('unit_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('notes')->nullable();
            $table->boolean('is_cooking')->default(0);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
