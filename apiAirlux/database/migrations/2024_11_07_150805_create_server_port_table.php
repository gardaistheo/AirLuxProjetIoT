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
        Schema::create('server_ports', function (Blueprint $table) {
            $table->id();
            $table->integer('port');
            $table->boolean('dispo');
            $table->timestamps();
        });

        // Appeler le seeder après la création de la table
        Artisan::call('db:seed', [
            '--class' => 'ServerPortsSeeder',
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_port');
    }
};
