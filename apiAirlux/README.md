Voici une version formatée pour un fichier .md :

# Mise en place de la route `/ping` sur l'API Laravel

La route `/ping` est conçue pour renvoyer un **timestamp**. Ce timestamp peut être utilisé pour mettre à jour la base de données, en remplaçant le timestamp du dernier ping.

---

## Objectif

- Permettre de récupérer un timestamp via une requête à l'API.
- Utiliser ce timestamp pour mettre à jour le champ du dernier ping dans la base de données.

---

## Fonctionnement

### Code de la route `/ping`

```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PingController extends Controller
{
    public function ping() {
        return response()->json(['timestamp' => time()], 200);
    }
}
```

À faire (To-Do)

	1.	Tester que l’API renvoie bien le timestamp
	•	Envoyer une requête à la route /ping.
	•	Vérifier que la réponse contient un champ "timestamp" avec une valeur correcte (par exemple, en utilisant Postman ou cURL).
	2.	Mettre à jour la base de données
	•	Identifier la table et le champ à mettre à jour (exemple : last_ping dans une table devices).
	•	Implémenter la logique pour insérer le timestamp reçu dans la base de données.

Exemple de test avec cURL

curl -X GET http://ton-domaine-api.com/api/ping

Réponse attendue :

{
    "timestamp": 1701025076
}

