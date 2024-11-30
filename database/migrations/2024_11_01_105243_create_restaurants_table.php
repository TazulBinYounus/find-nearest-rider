<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name')->index(); // Restaurant name
            $table->decimal('lat', 10, 8); // Latitude
            $table->decimal('long', 11, 8); // Longitude
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
