<?php

namespace qms\Http\Controllers;

use Illuminate\Http\Request;

class SistemaController extends Controller
{
  public function manualOperador() {
    return view('sistema.manual-operador');
  }

  public function manualAdministrador() {
    return view('sistema.manual-administrador');
  }
}
