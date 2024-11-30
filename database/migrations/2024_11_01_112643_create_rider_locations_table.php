<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('rider_locations', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('rider_id')->constrained('riders')->index(); // Foreign key referencing riders table
            $table->decimal('lat', 10, 8); // Latitude with precision
            $table->decimal('long', 11, 8); // Longitude with precision
            $table->timestamp('captured_at'); // Timestamp for when the location was captured
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('rider_locations');
    }
}
