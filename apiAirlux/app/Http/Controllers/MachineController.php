<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Controllers\MappingsController;

class MachineController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'mac_address' => 'required|string',
            'ssh_key' => 'required|string',
            'given_ports' => 'required|string',
        ]);

        // Vérifier si une machine avec cette adresse MAC existe déjà
        $machineExiste = Machine::where('mac_address', $validatedData['mac_address']);

        if (!$machineExiste) {
            // Si aucune machine n'a été mise à jour, en créer une nouvelle
            $newMachine = Machine::create([
                'mac_address' => $validatedData['mac_address'],
                'ssh_key' => $validatedData['ssh_key'],
                'last_ping' => now(),
            ]);

            $machineExiste = $newMachine;

            // Créer un mapping pour chaque port donné
            MappingsController::setMapping($newMachine, $validatedData['given_ports']);
        } else {
            // Mettre à jour les mappings
            MappingsController::updateMapping($machineExiste, $validatedData['given_ports']);
        }

        return response()->json([
            'message' => 'Succès',
            'machine' => $machineExiste
        ], 200);
    }
}

