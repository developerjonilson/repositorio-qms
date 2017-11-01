<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Endereco;
use \qms\Models\Telefone;
use \qms\Models\Consulta;
use \qms\Models\Especialidade;
use \qms\Models\Calendario;

class Medico extends Model
{
  protected $table = 'medicos';

  protected $primaryKey = 'id_medico';

  protected $fillable = [
      'nome_medico', 'numero_crm', 'endereco_id', 'telefone_id',
  ];

  public function endereco(){
     return $this->hasOne(Endereco::class);
  }

  public function telefone(){
     return $this->hasOne(Telefone::class);
  }

  public function especialidades() {
    return $this->belongsToMany(Especialidade::class, 'especialidade_medico', 'id_medico', 'id_especialidade');
  }

  public function calendarios(){
     return $this->hasMany(Calendario::class);
  }

  public function consulta(){
    return $this->belongsTo(Consulta::class);
  }
}
