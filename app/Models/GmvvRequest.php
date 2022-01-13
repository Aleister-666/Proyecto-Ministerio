<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use App\Models\Task;
use App\Models\Client;
use App\Models\Document;

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


    public function files_path()
    {
        $files = [];
        $path;
        
        foreach ($this->toArray() as $key => $value) {
            $document = Document::find($value);
            if (is_null($document)) {
                $files[$key] = null;
            } else {
                $file_path = $document->file_path;
                $files[$key] = Storage::disk('departaments')->url($file_path);
            }
        }

        return $files;
    }

    public function get_file_path($column)
    {
        $select = $this->toArray()[$column];
        $file_path;
        if (!is_null($select)) {
            $path = Document::find($select)->file_path;
            $file_path = Storage::disk('departaments')->url($path); 
        } else {
            $file_path = null;
        }

        return $file_path;
    }

    public function files_name()
    {
        $select = $this->toArray();
        $files_name = [];

        foreach ($select as $key => $value) {

        }        

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

    protected $attributes = [
        'copy_ci' => null,
        'contancy_job' => null,
        'contancy_home' => null,
        'contancy_civil' => null,
        'birth_certificate_children' => null,
        'sworn_declaration' => null,
        'registration_form_gmvv' => null,
        'explanatory_statement' => null
    ];

    protected $hidden = [
        'id',
        'task_id',
        'client_id',
        'created_at',
        'updated_at'
    ];
}
