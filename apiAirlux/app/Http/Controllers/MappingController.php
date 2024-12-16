<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapping;
use App\Models\ServerPorts;
use App\Models\Machine;
use App\Http\Controllers\ServerPortsController;
use Illuminate\Support\Facades\Log;


class MappingController extends Controller
{
    public static function setMapping($machine, $given_ports)
    {
        $createdMappings = [];
        // Récupérer les ports qui ont le champ disponible à true
        $disponiblePorts = ServerPorts::where('dispo', true);

        if (!$disponiblePorts) {
            // Si aucun port n'est disponible, retourner un message d'erreur
            return response()->json(['message' => 'Aucun port disponible'], 400);
        } else {
            // On récupère tout les ports demandés par la machine
            $ports_demande = explode(",", $given_ports);
            // On récupère un port disponible
            $ports_dispo = ServerPorts::where('dispo', true)->get();

            // Pour chaque port demandé, on crée un mapping
            for ($i = 0; $i < count($ports_demande); $i++) {
                // On récupère un port disponible
                $port_dispo = $ports_dispo[$i];
                // On crée un mapping
                $mapping = new Mapping();
                $mapping->mac_address = $machine->mac_address;
                $mapping->server_port = $port_dispo->port;
                $mapping->machine_port = intval($ports_demande[$i]);
                $mapping->save();
                array_push($createdMappings, $mapping);

                // On met le port à non disponible
                $port_dispo->dispo = false;
                $port_dispo->save();
            }
        }

        return response()->json([
            'message' => 'Succès',
            'mappings' => $createdMappings
        ], 200);
    }

    public static function updateMapping($machine, $given_ports)
    {
        Log::info('\UPDATE MAPPING');
        $createdMappings = [];
        $deletedMappings = [];

        //Récuperer les mappings de la machine
        $mappings = Mapping::where('mac_address', $machine->mac_address)->get();

        //Supprimer les mappings
        for($i = 0; $i < count($mappings); $i++){
            //Récuperer le port du serveur
            $port = ServerPorts::where('port', $mappings[$i]->server_port)->first();
            Log::info('Port trouvé : '. $port);
            //Mettre le port à disponible
            $port->dispo = true;
            $port->save();
            //Supprimer le mapping
            array_push($deletedMappings, $mappings[$i]);
            $mappings[$i]->delete();
        }

        Log::info('Mappings supprimés ');

        //On récupère tout les ports demandés par la machine
        $ports = $machine->ports;
        $ports = explode(",", $ports);
        //On récupère un port disponible
        $ports_dispo = ServerPorts::where('dispo', true)->get();


        //Pour chaque port demandé, on crée un mapping
        for($i = 0; $i < count($ports); $i++){
            //On récupère un port disponible
            $port = $ports_dispo[$i];
            //On crée un mapping
            $mapping = new Mapping();
            $mapping->mac_address = $machine->mac_address;
            $mapping->server_port = $port->port;
            $mapping->machine_port = intval($ports[$i]);
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
