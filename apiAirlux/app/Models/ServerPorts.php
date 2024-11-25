<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerPorts extends Model
{
    use HasFactory;

    protected $fillable = [
        'port',
        'dispo'
    ];
}
