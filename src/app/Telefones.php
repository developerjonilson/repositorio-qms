<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;

class Telefones extends Model
{
  protected $table = 'telefones';

  public function user(){
      return $this->belongsTo('App\User');
  }
}
