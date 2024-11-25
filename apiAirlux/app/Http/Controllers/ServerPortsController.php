<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerPortsController extends Controller
{
    public function getDisponiblePorts()
    {

        // Récupérer les ports qui ont le champ disponible à true
        $disponiblePorts = ServerPorts::where('dispo', true);

        if (!$disponiblePorts) {
            // Si aucun port n'est disponible, retourner un message d'erreur
            return response()->json(['message' => 'Aucun port disponible'], 400);
        }

        return response()->json([
            'message' => 'Succès',
            'ports' => $disponiblePorts
        ], 200);
    }

    public function updateDispoPort($port)
    {
        // Récupérer le port
        $port = ServerPorts::where('port', $port);

        if (!$port) {
            // Si le port n'existe pas, retourner un message d'erreur
            return response()->json(['message' => 'Port non trouvé'], 400);
        }

        // Mettre le champ disponible à false
        $port->dispo = false;
        $port->save();

        return response()->json([
            'message' => 'Succès',
            'port' => $port,
            'dispo' => $port->dispo
        ], 200);
    }
}
