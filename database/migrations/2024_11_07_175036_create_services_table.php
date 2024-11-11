<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->integer('price');
            $table->timestamps();
        });

        DB::table('services')->insert([
            [
                'service' => 'Consultation',
                'price' => '500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service' => 'Periapical Radiograph',
                'price' => '750',
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
        Schema::dropIfExists('services');
    }
};
