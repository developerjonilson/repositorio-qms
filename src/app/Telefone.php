<?php

namespace qms;

use Illuminate\Database\Eloquent\Model;
use \qms\User;
use \qms\Paciente;
use \qms\Medico;
use \qms\Local;

class Telefone extends Model
{
  protected $table = 'telefones';

  protected $fillable = [
      'telefone_um', 'telefone_dois',
  ];

  public function user(){
      return $this->belongsTo(User::class);
  }

  public function paciente(){
      return $this->belongsTo(Paciente::class);
  }

  public function medico(){
      return $this->belongsTo(Medico::class);
  }

  public function local(){
      return $this->belongsTo(Local::class);
  }
}
