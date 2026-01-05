<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->date('birthdate')->nullable();
            $table->timestamps();
        });

        DB::table('personas')->insert([
            [
                'id' => 1,
                'name' => 'Huub Duinmeijer',
                'email' => 'huubduinmeijer@gmail.com',
                'birthdate' => '1990-05-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Thays Araujo',
                'email' => 'thayssyat@hotmail.com',
                'birthdate' => '1995-06-29',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
