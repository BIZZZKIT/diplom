<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('premises', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->string('count_room');
            $table->integer('square');
            $table->enum('typeOfSell', ['Аренда', 'Продажа']);
            $table->foreignIdFor(\App\Models\FederalDistricts::class, 'district_id');
            $table->foreignIdFor(\App\Models\Regions::class, 'region_id');
            $table->enum('flatOrHouse', ['Квартира', 'Дом']);
            $table->foreignIdFor(\App\Models\Cities::class, 'city_id');
            $table->string('description');
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premises');
    }
};
