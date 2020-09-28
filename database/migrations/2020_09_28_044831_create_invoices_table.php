<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constraint();
            $table->foreignId('client_id')->constraint();
            $table->foreignId('project_id')->constraint();
            $table->string('generatedId');
            $table->string('payment_type')->default('stripe');
            $table->boolean('is_paid')->default(false);
            $table->datetime('due');
            $table->integer('sub_total');
            $table->integer('discount')->nullable();
            $table->integer('grand_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
