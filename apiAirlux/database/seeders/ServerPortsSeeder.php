<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerPortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($port = 1; $port <= 100; $port++) {
            if($port == 51 || $port == 52 || $port == 53 || $port == 54){
                $data[] = [
                    'port' => $port,
                    'dispo' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                continue;
            }
            $data[] = [
                'port' => $port,
                'dispo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('server_ports')->insert($data);
    }
}
