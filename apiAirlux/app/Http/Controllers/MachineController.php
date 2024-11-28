<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Http\Controllers\MappingController;
use Illuminate\Support\Facades\Log;

class MachineController extends Controller
{
    public function register(Request $request)
    {
        // Valider les données
        $validatedData = $request->validate([
            'mac_address' => 'required|string',
            'ssh_key' => 'required|string',
            'given_ports' => 'required|string',
        ]);


        // Vérifier si une machine avec cette adresse MAC existe déjà
        $machineExiste = Machine::where('mac_address', $validatedData['mac_address'])->first();

        if (!$machineExiste) {
            // Si aucune machine n'a été mise à jour, en créer une nouvelle
            $newMachine = Machine::create([
                'mac_address' => $validatedData['mac_address'],
                'ssh_key' => $validatedData['ssh_key'],
                'last_ping' => now(),
            ]);


            $machineExiste = $newMachine;

            // Créer un mapping pour chaque port donné
            MappingController::setMapping($newMachine, $validatedData['given_ports']);

        } else {
            Log::info('ELSE');
            // Mettre à jour les mappings
            MappingController::updateMapping($machineExiste, $validatedData['given_ports']);
            Log::info('Mapping updated');
            // Mettre à jour la date du dernier ping
            //TODO : Vérifier si la date est bien mise à jour (il semplerait que non)
            $machineExiste->last_ping = now();
            // Mettre à jour la clé ssh si elle est différente
            if ($machineExiste->ssh_key != $validatedData['ssh_key']) {
                $machineExiste->ssh_key = $validatedData['ssh_key'];
            }

            Log::info('Before Save: ' . json_encode($machineExiste->toArray()));

            $machineExiste->save();
        }

        return response()->json([
            'message' => 'Succès',
            'machine' => $machineExiste
        ], 200);
    }
}

