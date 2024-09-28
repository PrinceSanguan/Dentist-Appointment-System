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
            $table->enum('userRole', ['admin', 'patient', 'dentist']);
            $table->string('password');
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
