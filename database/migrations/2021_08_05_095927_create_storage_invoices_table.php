<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('storage_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable()->index();
            $table->date('date');
            $table->enum('type', ["in","out"]);
            $table->foreignId('supplier_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('total', 10, 4)->nullable();
            $table->decimal('received', 8, 4)->nullable();
            $table->decimal('remaining', 10, 4)->virtualAs('total - received');
            $table->boolean('is_finished')->virtualAs('total = received')->nullable()->index();
            $table->foreignId('inventory_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('created_by')->nullable()->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('storage_invoices');
    }
}
