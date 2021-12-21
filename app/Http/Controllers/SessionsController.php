<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
  /**
   * Proporciona la vista del login
   */
  public function new()
  {
    return view('sessions/new');
  }

  /**
   * Crea la session para un usuario. comprueba que la cedula y la contraseña coincidan
   * con un usuario registrado
   */
  public function create()
  {

    $credentials = request()->validate([
      'cedula' => ['required'],
      'password' => ['required']
    ]);
    
    $remember_token = !empty(request('remember'));

    if (auth()->attempt(['cedula' => request('cedula'), 'password' => request('password')], $remember_token)) {
      return redirect()->route('workplace_path');
    } else{
      return back()->withErrors([
        'message' => 'Cedula o Contraseña Invalidos'
      ]);
    }

  }

  /**
   * Destruye la session del usuario. Cierra Session
   */
  public function destroy()
  {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('root_path');

  }
}
