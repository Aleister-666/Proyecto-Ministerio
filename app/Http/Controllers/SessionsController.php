<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
  public function new()
  {
    return view('sessions/new');
  }

  public function create()
  {
    $remember_token = !empty(request('remember'));
    $credentials = request()->validate([
      'cedula' => ['required'],
      'password' => ['required']
    ]);

    if (auth()->attempt(['cedula' => request('cedula'), 'password' => request('password')], $remember_token)) {
      return redirect()->route('workplace_path');
    } else{
      return back()->withErrors([
        'message' => 'Cedula o Contraseña Invalidos'
      ]);
    }

  }

  public function destroy()
  {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('root_path');

  }
}
