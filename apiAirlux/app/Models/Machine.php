<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    // Définir mac_address comme clé primaire
    protected $primaryKey = 'mac_address';

    // Indiquer que la clé primaire n'est pas auto-incrémentée
    public $incrementing = false;

    // Indiquer que la clé primaire est de type string
    protected $keyType = 'string';
    
    protected $fillable = [
        'mac_address',
        'ssh_key',
        'last_ping'
    ];
}
