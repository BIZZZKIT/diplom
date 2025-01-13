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
            $table->string('deletedForReason')->nullable();
            $table->string('bannedOwner')->nullable();
            $table->foreignId('district_id')
                ->constrained('federal_districts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('region_id')
                ->constrained('regions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->constrained('cities')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->enum('flatOrHouse', ['Квартира', 'Дом']);
            $table->string('description');
            $table->string('address');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

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

//
//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;
//
//return new class extends Migration
//{
//    /**
//     * Run the migrations.
//     */
//    public function up(): void
//    {
//        Schema::create('premises', function (Blueprint $table) {
//            $table->id();
//            $table->string('price');
//            $table->string('count_room');
//            $table->integer('square');
//            $table->enum('typeOfSell', ['Аренда', 'Продажа']);
//            $table->foreignIdFor(\App\Models\FederalDistricts::class, 'district_id');
//            $table->foreignIdFor(\App\Models\Regions::class, 'region_id');
//            $table->enum('flatOrHouse', ['Квартира', 'Дом']);
//            $table->foreignIdFor(\App\Models\Cities::class, 'city_id');
//            $table->string('description');
//            $table->string('address');
//            $table->foreignIdFor(\App\Models\User::class, 'user_id');
//            $table->timestamps();
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     */
//    public function down(): void
//    {
//        Schema::dropIfExists('premises');
//    }
//};
