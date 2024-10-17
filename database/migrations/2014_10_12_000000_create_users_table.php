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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('number');
            $table->string('address');
            $table->date('dob');
            $table->enum('userRole', ['admin', 'patient', 'dentist', 'assistant']);
            $table->string('password');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });

        // Insert default data after the table has been created
        DB::table('users')->insert([
            [
                'full_name' => 'admin',
                'email' => 'admin@gmail.com',
                'number' => '09123456789',
                'address' => 'dyan lang po',
                'dob' => '2024-09-11',
                'userRole' => 'admin',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Juan Dela Cruz',
                'email' => 'patient@gmail.com',
                'number' => '09123456789',
                'address' => 'Makati City',
                'dob' => '2024-09-11',
                'userRole' => 'patient',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Willie Ong',
                'email' => 'dentist@gmail.com',
                'number' => '09123456789',
                'address' => 'BGC Bicutan City',
                'dob' => '2024-09-11',
                'userRole' => 'dentist',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Apolinario Mabini',
                'email' => 'assistant@gmail.com',
                'number' => '09123456789',
                'address' => 'Mauway, Mandaluyong City',
                'dob' => '2024-09-11',
                'userRole' => 'assistant',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Jose Rizal',
                'email' => 'patient2@gmail.com',
                'number' => '09123456789',
                'address' => 'Bulacan',
                'dob' => '2024-09-11',
                'userRole' => 'patient',
                'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password
                'status' => 'active',
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
        Schema::dropIfExists('users');
    }
};
