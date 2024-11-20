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
    Schema::create('food', function (Blueprint $table) {
        $table->id();
        $table->string('foodname');
        $table->string('foodimage');
        $table->decimal('sale_price', 10, 2);
        $table->decimal('purchase_price', 10, 2);
        $table->text('description')->nullable();
        $table->unsignedBigInteger('admin_id');
        $table->timestamps();

        // Foreign key for admin_id
        $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
