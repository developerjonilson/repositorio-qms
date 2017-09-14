<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\Cidade;

class Estado extends Model
{

  protected $table = 'estados';

  protected $fillable = [
      'nome_estado',
  ];

  public function cidade(){
      return $this->belongsTo(Cidade::class);
  }

}
