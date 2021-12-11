<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class NamesClient extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected $fillable = [
        'first_name',
        'first_surname',
        'second_name',
        'second_surname',
    ];
}
