<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Document;


class DocumentsController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $departament = $user->departament->name;

        $this->validates_fields();

        if (request()->file()) {

            $file = request()->file('file');

            $file_name = $file->hashName();

            $file_path = $file->storeAs("{$departament}/{$user->cedula}", $file_name, "departaments");

            if (Storage::disk('departaments')->exists($file_path)){
                
                $document = Document::create([
                    'title' => request('title'),
                    'description' => request('description'),
                    'file_name' => $file_name,
                    'file_path' => $file_path,
                    'user_id' => $user->id,
                    'departament_id' => $user->departament->id
                ]);

                return back()->with('success', 'Documento Subido')->with('file', $file_name);

            } else {
                return back()->withErrors([
                  'message' => 'ERROR AL SUBIR DOCUMENTO'
                ]);
            }
        } else {
            return "ERROR GRAVE";
        }

    }

    public function update($id)
    {
        $user = auth()->user();
        $departament = $user->departament->name;
        $document = $user->documents->find($id);

        $this->validates_fields();

        if (request()->file()) {
            if (Storage::disk('departaments')->exists($document->file_path)) {
                $file_name = $document->file_name;
                Storage::disk('departaments')->delete($document->file_path);
            } else {
                return back()->withErrors([
                  'message' => 'ERROR AL EDITAR DOCUMENTO'
                ]);
            }

            $file = request()->file('file');
            $file_path = $file->storeAs("{$departament}/{$user->cedula}", $file_name, "departaments");

            if (Storage::disk('departaments')->exists($file_path)) {
                
                $document->update([
                    'title' => request('title'),
                    'description' => request('description'),
                    'file_name' => $file_name,
                    'file_path' => $file_path,
                    'user_id' => $user->id,
                    'departament_id' => $user->departament->id
                ]);

                return redirect(route('list_documents_path'))->with('success', 'Documento Actualizado');

            } else {

                return back()->withErrors([
                  'message' => 'ERROR AL ACTUALIZAR DOCUMENTO'
                ]);

            }
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $document = $user->documents->find($id);

        if (Storage::disk('departaments')->exists("{$document->file_path}")) {
            Storage::disk('departaments')->delete($document->file_path);
            $document->delete();
            return back()->with('success', 'Documento Eliminado');

        } else {
            return "NOEsta";
        }

    }

    public function download($id)
    {
        $document = auth()->user()->documents->find($id);
        return Storage::disk('departaments')->download($document->file_path);
    }

    private function validates_fields()
    {
        return $validates = request()->validate([
            "title" => ['required'],
            "file" => ['required',
                       'file',
                       'max:25600',
                       'mimes:pdf,doc,docx,pptx,xlsx']
        ]);
    }

}
