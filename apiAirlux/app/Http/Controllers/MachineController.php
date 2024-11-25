<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;

class MachineController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mac_address' => 'required|string',
            'machine_port' => 'required|integer',
            'server_port' => 'required|integer',
            'ssh_key' => 'required|string',
        ]);

        // Vérifier si une machine avec cette adresse MAC existe déjà
        $updated = Machine::where('mac_address', $validatedData['mac_address'])
                    ->update([
                        'machine_port' => $validatedData['machine_port'],
                        'server_port' => $validatedData['server_port'],
                        'updated_at' => now(),
                    ]);

        if (!$updated) {
            // Si aucune machine n'a été mise à jour, en créer une nouvelle
            Machine::create($validatedData);
        }

        return response()->json(['message' => 'Succès'], 200);
    }
}

