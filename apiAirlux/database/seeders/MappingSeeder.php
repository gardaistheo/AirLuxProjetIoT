<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mappings')->insert([
            ['mac_address' => 'exampleMacAddress', 'server_port' => 51, 'machine_port' => 31, 'created_at' => now(), 'updated_at' => now()],
            ['mac_address' => 'exampleMacAddress', 'server_port' => 52, 'machine_port' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['mac_address' => 'exampleMacAddress', 'server_port' => 53, 'machine_port' => 64, 'created_at' => now(), 'updated_at' => now()],
            ['mac_address' => 'exampleMacAddress', 'server_port' => 54, 'machine_port' => 22, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
