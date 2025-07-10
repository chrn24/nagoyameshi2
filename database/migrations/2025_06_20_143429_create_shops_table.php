<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
              $table->id();
              $table->foreignId('category_id')->constrained()->onDelete('cascade');
              $table->string('name', 100);
              $table->text('image')->nullable();
              $table->string('description')->nullable();
              $table->integer('price_min')->nullable();
              $table->integer('price_max')->nullable();
              $table->string('business_hours', 100)->nullable();
              $table->string('business_period', 100)->nullable();
              $table->string('closed_day', 100)->nullable();
              $table->string('zip_code', 10)->nullable();
              $table->string('address')->nullable();
              $table->string('phone_number', 20)->nullable();
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
        Schema::dropIfExists('shops');
    }
};
