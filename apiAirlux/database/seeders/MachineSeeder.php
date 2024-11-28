<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('machines')->insert([
            ['mac_address' => 'exampleMacAddress', 'ssh_key' => 'exampleSshKey', 'last_ping' => now(), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
