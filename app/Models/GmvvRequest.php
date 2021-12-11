<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Task;
use App\Models\Client;

class GmvvRequest extends Model
{
    use HasFactory;

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected $fillable = [
        'copy_ci',
        'contancy_job',
        'contancy_home',
        'contancy_civil',
        'birth_certificate_children',
        'sworn_declaration',
        'registration_form_gmvv',
        'explanatory_statement',
        'task_id',
        'client_id'
    ];
}
