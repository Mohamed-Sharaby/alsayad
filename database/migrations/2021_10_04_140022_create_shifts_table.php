<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Admin::class)->constrained()->cascadeOnDelete();
            $table->foreignId('cashier_id')->nullable()->constrained('cashiers')->nullOnDelete();
           // $table->foreignIdFor(\App\Models\Receiving::class)->nullable()->constrained()->nullOnDelete();
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->boolean('is_open')->index()->storedAs("(end_at is null)");
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

        Schema::dropIfExists('shifts');
        Schema::enableForeignKeyConstraints();

    }
}
