<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        "message",
        "type",
        "from",
        "fromMe",
        "hasMedia"
    ];
}
