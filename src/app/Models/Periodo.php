<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Calendario;
use \qms\Models\Consulta;
use \qms\Models\Local;

class Periodo extends Model
{
  protected $table = 'periodos';

  protected $fillable = [
      'nome', 'total_consultas', 'vagas_disponiveis', 'calendario_id', 'local_id',
  ];

  public function calendario() {
    return $this->belongsTo(Calendario::class);
  }

  public function consulta(){
    return $this->belongsTo(Consulta::class);
  }

  public function local(){
     return $this->hasOne(Local::class);
  }

}
