<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Cidade;

class Estado extends Model
{

  protected $table = 'estados';

  protected $primaryKey = 'id_estado';

  protected $fillable = [
      'nome_estado',
  ];

  public function cidade(){
      return $this->belongsTo(Cidade::class);
  }

}
