<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('receivings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Shift::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Cashier::class)->constrained()->cascadeOnDelete();
            $table->decimal('total', 10, 5);
            $table->decimal('delivered', 10, 5)->default(0);
            $table->decimal('remaining', 10, 5)->storedAs('(total - delivered)');

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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('receivings');
        Schema::enableForeignKeyConstraints();

    }
}
