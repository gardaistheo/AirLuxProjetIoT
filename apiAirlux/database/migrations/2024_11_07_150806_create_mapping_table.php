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
        Schema::create('mappings', function (Blueprint $table) {
            $table->id();
            $table->string('mac_address');
            $table->foreign('mac_address')->references('mac_address')->on('machines');
            $table->integer('server_port');
            $table->foreign('server_port')->references('id')->on('server_port');
            $table->integer('machine_port');
            $table->timestamps();
        });
        // Appeler le seeder après la création de la table
        Artisan::call('db:seed', [
            '--class' => 'MappingSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping');
    }
};
