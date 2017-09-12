<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

  protected $table = 'estados';

  public function cidade(){
      return $this->belongsTo('App\cidade');
  }

}
