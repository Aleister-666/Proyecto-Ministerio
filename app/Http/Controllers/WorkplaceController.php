<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkplaceController extends Controller
{
    /**
     * Proporciona la vista index
     * @return Html HTML con las datos del usuario actualmente loggeado
     */
    public function index()
    {
        $user = auth()->user();
        return view('workplace/index', compact('user'));
    }

    public function list_documents()
    {
        $user = auth()->user();
        return view('workplace/actions/list_documents', compact('user'));
    }

    public function up_document()
    {
        $user = auth()->user();
        return view('workplace/actions/upload_document', compact('user'));
    }

    public function edit_document($id)
    {
        $user = auth()->user();
        $document = $user->documents->find($id);
        return view('workplace/actions/edit_document', compact('user', 'document'));
    }
    
}
