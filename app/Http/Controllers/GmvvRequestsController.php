<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Madzipper;


use App\Models\Client;
use App\Models\Task;
use App\Models\GmvvRequest;

class GmvvRequestsController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $clients = $this->gmvv_requests_clients(); 

        return view('gmvv_requests/index', compact('user', 'clients'));
    }

    public function search()
    {
        $cedula = request()->cedula;
        $clients = $this->gmvv_requests_clients($cedula);
        return view('gmvv_requests/partials/search_results', compact('clients'));

    }

    public function new()
    {   
        $user = auth()->user();
        return view('gmvv_requests/new', compact('user'));
    }

    public function create()
    {
        $this->validates_fields();

        $user = auth()->user();

        $client_data = array_merge(request()->only('cedula', 'email', 'telefono', 'sex'), ['user_id' => $user->id]);
        $client_names_data = request()->only('first_name', 'first_surname', 'second_name', 'second_surname');

        if (request()->file()) {
            $files = request()->allFiles();
        } else {
            return back()->withErrors([
              'message' => 'Error al Registrar Peticion'
            ]);
        }

        $client = Client::create($client_data);
        $client->names()->create($client_names_data);

        $task = $user->tasks()->create(['departament_id' => $user->departament->id]);

        $path = "{$user->departament->name}/{$user->cedula}/gmvv_request/{$client->cedula}";

        $gmvv_request = $this->store_documents($files, $path, 'departaments', $client, $task);

        if ($gmvv_request) {
            return back()->with('success', 'Peticion Registrada');
        } else {
            $task->delete();
            $client->delete();
            
            return back()->withErrors([
              'message' => 'Error al registrar peticion'
            ]);
        }

    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $task = $client->gmvv_request->task;

        $path = "{$client->user->departament->name}/{$client->user->cedula}/gmvv_request/{$client->cedula}";

        if (Storage::disk('departaments')->exists($path)) {
            Storage::disk('departaments')->deleteDirectory($path);
            $task->delete();
            $client->delete();

            return redirect()->route('index_gmvv_request_path')
                    ->with('success', 'Solicitud Eliminada');
        } else {
            return back()->withErrors([
                'message' => 'ERROR AL BORRAR REGISTRO'
            ]);
        }
    }

    public function download($id)
    {
        $user = auth()->user();
        $departament = $user->departament;
        $client = Client::find($id);

        $path = "{$departament->name}/{$user->cedula}/gmvv_request/{$client->cedula}";
        $path_zip = "app/departaments/{$path}/{$client->cedula}.zip";

        $files = glob(storage_path("app/departaments/{$path}/*"));

        Madzipper::make(storage_path($path_zip))
            ->add($files)->close();

        return response()->download(storage_path($path_zip));
    }

    private function validates_fields($id = '')
    {
        return $validates = request()->validate([
            "first_name" => ['required', 'string'],
            "first_surname" => ['required', 'string'],
            "second_name" => ['string', 'nullable'],
            "second_surname" => ['string', 'nullable'],
            "cedula" => ['required', 'string', "unique:clients,cedula,{$id}", 'min:7', 'max:8'],
            "email" => ['required', 'string', "unique:clients,email,{$id}"],
            "telefono" => ['string', 'max:20', 'nullable'],
            "sex" => ['required', 'max:12'],

            "copy_ci" => ['required',
                          'file',
                          'max:25600',
                          'mimes:pdf,doc,docx,pptx,xlsx'],

            "contancy_job" => ['required',
                               'file',
                               'max:25600',
                               'mimes:pdf,doc,docx,pptx,xlsx'],

            "contancy_home" => ['required',
                                'file',
                                'max:25600',
                                'mimes:pdf,doc,docx,pptx,xlsx'],

            "contancy_civil" => ['required',
                                 'file',
                                 'max:25600',
                                 'mimes:pdf,doc,docx,pptx,xlsx'],

            "birth_certificate_children" => ['required',
                                             'file',
                                             'max:25600',
                                             'mimes:pdf,doc,docx,pptx,xlsx'],

            "sworn_declaration" => ['required',
                                    'file',
                                    'max:25600',
                                    'mimes:pdf,doc,docx,pptx,xlsx'],

            "registration_form_gmvv" => ['required',
                                         'file',
                                         'max:25600',
                                         'mimes:pdf,doc,docx,pptx,xlsx'],

            "explanatory_statement" => ['required',
                                        'file',
                                        'max:25600',
                                        'mimes:pdf,doc,docx,pptx,xlsx']
        ]);
    }

    private function store_documents($documents, $path, $disk, $client, $task)
    {
        $files_path_store = [];
        $files_name_store = [];
        $complete_load_files = [];

        foreach ($documents as $key => $value) {
            $files_name_store[$key] = $client->cedula . "_{$key}_" . $value->hashName(); 
            $files_path_store[$key] = $value->storeAs($path, $files_name_store[$key], $disk);

            if(!Storage::disk($disk)->exists($files_path_store[$key])){
                $complete_load_files[$key] = false;
            } else {
                $complete_load_files[$key] = true;
            }
        }

        if (in_array(false, $complete_load_files, true)) {
            return false;
        } else {
            return $task->gmvv_requests()->create([
                'copy_ci' => $files_name_store['copy_ci'],
                'contancy_job' => $files_name_store['contancy_job'],
                'contancy_home' => $files_name_store['contancy_home'],
                'contancy_civil' => $files_name_store['contancy_civil'],
                'birth_certificate_children' => $files_name_store['birth_certificate_children'],
                'sworn_declaration' => $files_name_store['sworn_declaration'],
                'registration_form_gmvv' => $files_name_store['registration_form_gmvv'],
                'explanatory_statement' => $files_name_store['explanatory_statement'],
                'client_id' => $client->id               
            ]);
        }
    }

    private function gmvv_requests_clients($cedula = null)
    {
        $select = [
            'clients.id',
            'cedula',
            'first_name',
            'first_surname',
            'second_name',
            'second_surname',
            'email',
            'telefono'
        ];

        if ($cedula) {
            return Client::select(...$select)
                    ->join('names_clients', 'clients.id', '=', 'names_clients.client_id')
                    ->join('gmvv_requests', 'clients.id', '=', 'gmvv_requests.client_id')
                    ->where('cedula', 'LIKE', $cedula . "%")
                    ->paginate(20);
        } else {
            return Client::select(...$select)
                    ->join('names_clients', 'clients.id', '=', 'names_clients.client_id')
                    ->join('gmvv_requests', 'clients.id', '=', 'gmvv_requests.client_id')
                    ->paginate(20);

        }
    }

}
