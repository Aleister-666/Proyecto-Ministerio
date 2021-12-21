<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\NamesClient;

use App\Models\User;
use App\Models\Document;
use App\Models\GmvvRequest;

class Client extends Model
{
    use HasFactory;

    public function names()
    {
        return $this->hasOne(NamesClient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function gmvv_request()
    {
        return $this->hasOne(GmvvRequest::class);
    }

    protected $fillable = [
        'cedula',
        'email',
        'sex',
        'telefono',
        'user_id'
    ];
}
