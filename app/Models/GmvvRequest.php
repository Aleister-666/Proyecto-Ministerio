<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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


    public function files_client($base_path)
    {
        $files = [];
        $path;
        
        foreach ($this->toArray() as $key => $value) {
            $path = "{$base_path}/{$value}";
            $files[$key] = Storage::disk('departaments')->url($path);
        }

        return $files;
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

    protected $hidden = [
        'id',
        'task_id',
        'client_id',
        'created_at',
        'updated_at'
    ];
}
