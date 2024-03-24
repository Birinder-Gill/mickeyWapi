<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WapiMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        "from",
        "displayName",
        "to",
        "counter",
        "type",
        "messageText",
        "messageId",
        "fromMe",
        "messageHash",
    ];
}
