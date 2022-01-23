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

        $client_names_data = $this->format_strings($client_names_data);

        if (request()->file()) {
            $files = request()->allFiles();
        } else {
            $files = null;
        }

        
        $client = Client::create($client_data);
        $client->names()->create($client_names_data);

        $task = $user->tasks()->create(['state_id' => 1,'departament_id' => $user->departament->id]);

        $path = "{$user->departament->name}/clientes/{$client->cedula}/gmvv_request";


        $gmvv_request = $this->store_documents([
            "task" => $task,
            "disk_name" => 'departaments',
            "path_storage" => $path,
            "documents" => $files,
            "client" => $client,
            "gmvv_request" => null
        ]);

        if ($gmvv_request) {
            return redirect()
                ->route('index_gmvv_request_path')
                ->with('success', 'Peticion Registrada');
        } else {
            $task->delete();
            $client->delete();
            
            return back()->withErrors([
              'message' => 'Error al registrar peticion, algunos archivos no pudieron guardarse.'
            ]);
        }

    }

    public function edit($id_gmvv)
    {
        $user = auth()->user();
        $gmvv_request = GmvvRequest::find($id_gmvv);
        $client = $gmvv_request->client;
        $states = State::all();

        return view('gmvv_requests/edit', compact('user', 'gmvv_request', 'client', 'states'));
    }

    public function update($id_gmvv)
    {
        $user = auth()->user();
        $gmvv_request = GmvvRequest::find($id_gmvv);
        $client = $gmvv_request->client;
        $state = request('state_id');
        $this->validates_fields($client->id, false);

        $client_data = array_merge(request()->only('cedula', 'email', 'telefono', 'sex'));
        $client_names_data = request()->only('first_name', 'first_surname', 'second_name', 'second_surname');
        $client_names_data = $this->format_strings($client_names_data);
        $client->update($client_data);
        $client->names()->update($client_names_data);

        $path = "{$user->departament->name}/clientes/{$client->cedula}/gmvv_request";

        $files = request()->allFiles();

        $gmvv_request_update = $this->store_documents([
            "disk_name" => 'departaments',
            "path_storage" => $path,
            "documents" => $files,
            "client" => $client,
            "gmvv_request" => $gmvv_request
        ]);

        $gmvv_request->task->update([
            'state_id' => $state
        ]);

        if ($gmvv_request_update) {
            return redirect()->route('index_gmvv_request_path')->with('success', 'Peticion Actualizada');
        } else {
            
            return back()->withErrors([
              'message' => 'Error al Actualizar peticion GMVV'
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
        $departament = auth()->user()->departament->name;
        $client = Client::find($id);
        $task = $client->gmvv_request->task;

        $path = "{$departament}/clientes/{$client->cedula}/gmvv_request/";

        if (Storage::disk('departaments')->exists($path)) {
            Storage::disk('departaments')->deleteDirectory($path);
            $task->delete();
            $client->delete();

            return redirect()->route('index_gmvv_request_path')
                    ->with('success', 'Solicitud Eliminada');
        } else {
            $task->delete();
            $client->delete();
            return redirect()->route('index_gmvv_request_path')
                    ->with('success', 'Solicitud Eliminada');
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
        $client = Client::find($id);
        $client_name = "{$client->names->first_name} {$client->names->first_surname}";
        $task = 'GMVV';

        $zip_name = "{$client_name}_{$client->cedula}_{$task}.zip";
        $path = "{$user->departament->name}/clientes/{$client->cedula}/gmvv_request";
        $make_zip_path = "app/departaments/{$path}/{$zip_name}";
        $zip_path = "{$path}/{$zip_name}";

        if (Storage::disk('departaments')->exists($zip_path)) {
            Storage::disk('departaments')->delete($zip_path);
        }

        $this->create_zip([
            "path" => $path,
            "path_zip" => $make_zip_path
        ]);


        return Storage::disk('departaments')->download("{$path}/{$zip_name}");
    }

    /**
     * Metodo que retorna las direcciones url de los documentos de una peticion GMVV.
     * @return JSON url de los documentos de una peticion GMVV.
     */
    public function files()
    {
        $user = auth()->user();
        $client = Client::find(request()->client_id);

        return $client->gmvv_request->files_path(); 
    }

    /**
     * Metodo que se encarga de gestionar las validaciones de los campos para una solicitud GMVV
     * @param  String $id (Opcional) Id del cliente  las validaciones cambian dependiendo de si hay un cliente o no.
     * @return Array     coleccion con las validaciones de campos.
     */
    private function validates_fields($client_id = '', $documents = true)
    {
        $client_fields = [
            "first_name" => ['required', 'string'],
            "first_surname" => ['required', 'string'],
            "second_name" => ['string', 'nullable'],
            "second_surname" => ['string', 'nullable'],
            "cedula" => ['required', 'string', "unique:clients,cedula,{$client_id}", 'min:7', 'max:8'],
            "email" => ['string', "unique:clients,email,{$client_id}", 'nullable'],
            "telefono" => ['string', 'max:20', 'nullable'],
            "sex" => ['required', 'max:12']
        ];

        $documents_fields = [
            "copy_ci" => ['file',
                          'max:25600',
                          'mimes:pdf,doc,docx,pptx,xlsx',
                          'nullable'],

            "contancy_job" => ['file',
                               'max:25600',
                               'mimes:pdf,doc,docx,pptx,xlsx',
                               'nullable'],

            "contancy_home" => ['file',
                                'max:25600',
                                'mimes:pdf,doc,docx,pptx,xlsx',
                                'nullable'],

            "contancy_civil" => ['file',
                                 'max:25600',
                                 'mimes:pdf,doc,docx,pptx,xlsx',
                                 'nullable'],

            "birth_certificate_children" => ['file',
                                             'max:25600',
                                             'mimes:pdf,doc,docx,pptx,xlsx',
                                             'nullable'],

            "sworn_declaration" => ['file',
                                    'max:25600',
                                    'mimes:pdf,doc,docx,pptx,xlsx',
                                    'nullable'],

            "registration_form_gmvv" => ['file',
                                         'max:25600',
                                         'mimes:pdf,doc,docx,pptx,xlsx',
                                         'nullable'],

            "explanatory_statement" => ['file',
                                        'max:25600',
                                        'mimes:pdf,doc,docx,pptx,xlsx',
                                        'nullable']
        ];

        if ($documents) {
            $selection = array_merge($client_fields, $documents_fields);
            return $validates = request()->validate($selection);
        } else {
            return $validates = request()->validate($client_fields);
        }
    }

    /**
     * Metodo que guarda los documentos de una peticon GMVV en la base de datos y en el disco local
     * @param  Array $documents Documentos provenientes de la peticon de una solicitud GMVV 
     * @param  String $path     path de la ruta donde guardar en el disco
     * @param  String $disk     Nombre del disco donde guardar los documentos
     * @param  Client $client   Cliente que realizo la peticion GMVV
     * @param  Task $task       Tarea asociada con la creacion de una peticion GMVV
     * @param  GmvvRequest      En caso de Actulizacion pasar la peticion en params
     * @return GmvvRequest || Boolean      retorna un objeto de la clase GmvvRequest con los datos de la petcion ya establecidos o un Boleano en caso de actulizacion
     */
    private function store_documents($params)
    {

        $data = [];
        $files_path_store = [];
        $complete_load_files = [];

        if ($params['documents']) {
            $files_name_store = $this->format_names_documents($params['documents'], $params['client']->cedula);

            foreach ($params['documents'] as $key => $value) { 

                if ($params['gmvv_request']) {
                    $path = $params['gmvv_request']->get_file_path($key);
                    if (!is_null($path)) {
                        Storage::delete($path);
                    }
                }

                $files_path_store[$key] = $value->storeAs($params['path_storage'], $files_name_store[$key], $params['disk_name']);

                if(!Storage::disk($params['disk_name'])->exists($files_path_store[$key])){
                    $complete_load_files[$key] = false;
                } else {
                    $complete_load_files[$key] = true;
                }
            }

            if (in_array(false, $complete_load_files, true)) {
                Storage::disk($params['disk_name'])->deleteDirectory($params['path_storage']);
                return false;
            } else {

                foreach ($files_name_store as $key => $value) {

                    if ($params['gmvv_request'] && !is_null($params['gmvv_request'][$key])) {
                        $document_id = $params['gmvv_request'][$key];
                        $document = Document::find($document_id)->update([
                            'file_name' => $files_name_store[$key],
                            'file_path' => $files_path_store[$key]
                        ]);
                        $data[$key] = "{$document_id}";

                    } else {
                        $document = Document::create(['file_name' => $files_name_store[$key],
                                                      'file_path' => $files_path_store[$key],
                                                      'user_id' => $params['client']->user->id,
                                                      'client_id' => $params['client']->id
                        ]);
                        $data[$key] = "{$document->id}";
                    }

                }
                $data['client_id'] = $params['client']->id;

                if ($params['gmvv_request']) {
                    return $params['gmvv_request']->update($data);
                } else {
                    return $params['task']->gmvv_requests()->create($data);
                }
            }

        } else {

            if ($params['gmvv_request']) {
                return true;
            }
            $data['client_id'] = $params['client']->id;
            return $params['task']->gmvv_requests()->create($data);
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

    /**
     * Metodo que formatea colleciones de strings en formato minusculas y con la
     * primera letra en mayusculas
     * @param  array $array Coleccion de los Strings a formatear
     * @return array        Retorna un array con los datos formateados
     */
    private function format_strings($array)
    {
        $format = function($value) {
            return ucfirst(strtolower($value));
        };

        return array_map($format, $array);
    }

    private function format_names_documents($documents, $client_cedula)
    {
        $formated_names = [];

        foreach ($documents as $key => $value){
            $formated_names[$key] = $client_cedula . "_{$key}_" . $value->hashName();
        }

        return $formated_names;
    }

    private function create_zip($params) {
        $path = $params['path'];
        $files = glob(storage_path("app/departaments/{$path}/*"));
        $zipper = new Madzipper;
        $zipper->make(storage_path($params['path_zip']))->add($files);

        if ($zipper->getStatus()) {
            $zipper = null;
        }
    }

}
