<?php

namespace qms\Models;

use Illuminate\Database\Eloquent\Model;
use \qms\Models\Cidade;
use \qms\Models\Paciente;
use \qms\Models\Medico;
use \qms\Models\Local;
use \qms\User;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $primaryKey = 'id_endereco';

    protected $fillable = [
        'rua', 'numero', 'complemento', 'bairro', 'cidade_id',
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

    public function cidade(){
       return $this->hasOne(Cidade::class);
    }
}
