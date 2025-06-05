<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('table_id')->constrained('tables')->cascadeOnDelete();
            $table->string('status')->default('serve');
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('order_tables');
    }
};
