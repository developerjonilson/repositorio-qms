<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Endereco;
use \qms\Models\Telefone;
use \qms\Models\Consulta;
use \qms\Models\Periodo;

class Local extends Model
{
  protected $fillable = [
      'nome_fantasia', 'numero_cnes', 'nome_razao_social', 'endereco_id',
  ];

  public function endereco(){
     return $this->hasOne(Endereco::class);
  }

  public function telefone(){
     return $this->hasOne(Telefone::class);
  }

  public function consulta(){
    return $this->belongsTo(Consulta::class);
  }

  public function periodo(){
    return $this->belongsTo(Periodo::class);
  }

}
