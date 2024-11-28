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
        Schema::create('machines', function (Blueprint $table) {
            $table->string('mac_address')->unique()->primary();
            $table->text('ssh_key');
            $table->string('last_ping');
            $table->timestamps();
        });

        // Appeler le seeder après la création de la table
        Artisan::call('db:seed', [
            '--class' => 'MachineSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
