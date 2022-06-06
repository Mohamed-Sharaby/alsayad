<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index()->unique()->nullable();
            $table->date('date');
            $table->foreignId('client_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('total', 8, 4)->nullable();
            $table->decimal('received', 8, 4)->nullable();
            $table->decimal('remaining', 8, 4)->virtualAs('total - received');
            $table->boolean('is_finished')->virtualAs('total = received')->nullable()->index();
            $table->foreignId('created_by')->nullable()->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
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
        Schema::dropIfExists('sales');
    }
}
