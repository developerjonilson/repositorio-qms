<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\Endereco;

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

}
