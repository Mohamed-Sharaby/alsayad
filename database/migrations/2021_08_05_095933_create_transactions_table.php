<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('admins')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->nullableMorphs('billable');
            $table->nullableMorphs('person');
            $table->enum('type', ["in","out"])->index();
            $table->decimal('amount', 8, 4);
            $table->boolean('is_points')->default(0)->index();
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
        Schema::dropIfExists('transactions');
    }
}
