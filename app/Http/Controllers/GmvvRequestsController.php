<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Madnest\Madzipper\Madzipper;


use App\Models\Client;
use App\Models\Task;
use App\Models\State;
use App\Models\Document;
use App\Models\GmvvRequest;

class GmvvRequestsController extends Controller
{
    /**
     * Proporciona la vista del index que lista todos los registros echos por el usuario
     * actualmente logeado
     * @return html
     */
    public function index()
    {
        $user = auth()->user();
        $clients = $this->gmvv_requests_clients();
        return view('gmvv_requests/index', compact('user', 'clients'));
    }

    /**
     * Proporciona la vista para la creacion de una nueva solicitud GMVV
     * @return Html 
     */
    public function new()
    {   
        $user = auth()->user();
        return view('gmvv_requests/new', compact('user'));
    }

    /**
     * Realiza el registro de una nueva peticion GMVV. Crea un nuevo cliente y guarda los documentos
     * en la base de datos y en el disco del sistema.
     * @return Html
     */
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

        $task = $user->tasks()->create(['state_id' => 1,'departament_id' => $user->departament->id]);

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

    /**
     * Borra el registro de una peticion GMVV junto con el cliente que realizo dicha solicitud
     * y borra los documentos almacenas en el disco para dicho registro en la solicitud, ademas
     * de borrarlos de la base de datos
     * @param  String $id Id del cliente 
     * @return Html
     */
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

    /**
     * Metodo que controla la fucnion de busqueda por cedula en la vista
     * @return HTML parcial con los datos solicitados
     */
    public function search()
    {
        $cedula = request()->cedula;
        if ($cedula != "") {
            $clients = $this->gmvv_requests_clients($cedula);
        } else {
            $clients = $this->gmvv_requests_clients();
        }
        
        return view('gmvv_requests/partials/search_results', compact('clients'));
    }

    /**
     * Metodo que se encarga de gestionar la descarga de todos los documentos asociados
     * a una solicitud GMVV en base del id de un cliente
     * @param  String $id Id del cliente al cual se le quiere descargar todos sus documentos
     * @return ZIP     regresa una respuesta para descargar un archivo zip con todos los documentos
     */
    public function download($id)
    {
        $user = auth()->user();
        $departament = $user->departament;
        $client = Client::find($id);
        $client_firstname = $client->names->first_name;
        $client_firstsurname = $client->names->first_surname;
        $task = 'documentos_GMVV';
        $zip_name = "{$client->cedula}_{$client_firstname}_{$client_firstsurname}-{$task}.zip";

        $path = "{$departament->name}/{$user->cedula}/gmvv_request/{$client->cedula}";
        $path_zip = "app/departaments/{$path}/{$zip_name}";

        $files = glob(storage_path("app/departaments/{$path}/*"));

        if(!Storage::disk('departaments')->exists($path . "/{$zip_name}")){
            $zipper = new Madzipper;
            $zipper->make(storage_path($path_zip))
                ->add($files);

            if ($zipper->getStatus()) {
                $zipper = null;
                return response()->download(storage_path($path_zip));
            } else {
                return back()->withErrors([
                  'zip_status' => 'Error al descargar archivo'
                ]);
            }
        } else {
            return response()->download(storage_path($path_zip));

        }

    }

    /**
     * Metodo que retorna las direcciones url de los documentos de una peticion GMVV.
     * @return JSON url de los documentos de una peticion GMVV.
     */
    public function files()
    {
        $user = auth()->user();
        $client = Client::find(request()->client_id);
        $base_path = "{$user->departament->name}/{$user->cedula}/gmvv_request/{$client->cedula}";

        return $client->gmvv_request->files_client($base_path); 
    }

    /**
     * Metodo que se encarga de gestionar las validaciones de los campos para una solicitud GMVV
     * @param  String $id (Opcional) Id del cliente  las validaciones cambian dependiendo de si hay un cliente o no.
     * @return Array     coleccion con las validaciones de campos.
     */
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

    /**
     * Metodo que guarda los documentos de una peticon GMVV en la base de datos y en el disco local
     * @param  Array $documents Documentos provenientes de la peticon de una solicitud GMVV 
     * @param  String $path      path de la ruta donde guardar en el disco
     * @param  String $disk      Nombre del disco donde guardar los documentos
     * @param  Client $client    Cliente que realizo la peticion GMVV
     * @param  Task $task      Tarea asociada con la creacion de una peticion GMVV
     * @return GmvvRequest            retorna un objeto de la clase GmvvRequest con los datos de la petcion ya establecidos
     */
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

            foreach ($files_name_store as $key => $value) {
                Document::create([
                    'file_name' => $files_name_store[$key],
                    'file_path' => $files_path_store[$key],
                    'user_id' => $client->user->id,
                    'client_id' => $client->id
                ]);    
            }
            
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

    /**
     * Metodo que controla el cliente o clientes solicitado para realizar el proceso de busqueda
     * @param  String $cedula Cedula del cliente a solicitar
     * @return ArrayQuery         Regresa los datos de la peticion realizada a la base de datos
     */
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
                    ->where('cedula', 'LIKE',"%" . $cedula . "%")
                    ->paginate(20);
        } else {
            return Client::select(...$select)
                    ->join('names_clients', 'clients.id', '=', 'names_clients.client_id')
                    ->join('gmvv_requests', 'clients.id', '=', 'gmvv_requests.client_id')
                    ->paginate(20);

        }
    }

}
