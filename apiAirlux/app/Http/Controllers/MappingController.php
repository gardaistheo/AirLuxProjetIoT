<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapping;
use App\Models\ServerPorts;
use App\Models\Machine;
use App\Http\Controllers\ServerPortsController;

class MappingController extends Controller
{
    public function setMapping($machine, $given_ports)
    {
        $createdMappings = [];
        // Récupérer les ports qui ont le champ disponible à true
        $disponiblePorts = ServerPorts::where('dispo', true);

        if (!$disponiblePorts) {
            // Si aucun port n'est disponible, retourner un message d'erreur
            return response()->json(['message' => 'Aucun port disponible'], 400);
        } else {
            // On récupère tout les ports demandés par la machine
            $ports = explode(",", $given_ports);

            // Pour chaque port demandé, on crée un mapping
            for ($i = 0; $i < count($ports); $i++) {
                // On récupère un port disponible
                $port = ServerPorts::where('dispo', true)->first();

                // On crée un mapping
                $mapping = new Mapping();
                $mapping->mac_address = $machine->mac_address;
                $mapping->server_port = $port->port;
                $mapping->machine_port = $ports[$i];
                $mapping->save();
                array_push($createdMappings, $mapping);

                // On met le port à non disponible
                $port->dispo = false;
                $port->save();
            }
        }

        return response()->json([
            'message' => 'Succès',
            'mappings' => $createdMappings
        ], 200);
    }

    public function updateMapping($machine, $given_ports)
    {
        $createdMappings = [];
        $deletedMappings = [];

        //Récuperer les mappings de la machine
        $mappings = Mapping::where('mac_address', $machine->mac_address);

        //Supprimer les mappings
        for($i = 0; $i < count($mappings); $i++){
            //Récuperer le port du serveur
            $port = ServerPorts::where('port', $mappings[$i]->server_port);
            //Mettre le port à disponible
            $port->dispo = true;
            $port->save();
            //Supprimer le mapping
            array_push($deletedMappings, $mappings[$i]);
            $mappings[$i]->delete();
        }

        //On récupère tout les ports demandés par la machine
        $ports = $machine->ports;
        $ports = explode(",", $ports);


        //Pour chaque port demandé, on crée un mapping
        for($i = 0; $i < count($ports); $i++){
            //On récupère un port disponible
            $port = ServerPorts::where('dispo', true)->first();

            //On crée un mapping
            $mapping = new Mapping();
            $mapping->mac_address = $machine->mac_address;
            $mapping->server_port = $port->port;
            $mapping->machine_port = $ports[$i];
            $mapping->save();
            array_push($createdMappings, $mapping);

            //On met le port à non disponible
            $port->dispo = false;
            $port->save();
        }

        return response()->json([
            'message' => 'Succès',
            'created_mappings' => $createdMappings,
            'deleted_mappings' => $deletedMappings
        ], 200);
    }
}
