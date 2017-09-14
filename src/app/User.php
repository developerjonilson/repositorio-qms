<?php

namespace qms;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \qms\Endereco;
use \qms\Telefone;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'rg', 'tipo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function endereco(){
       return $this->hasOne(Endereco::class);
    }

    public function telefone(){
       return $this->hasOne(Telefone::class);
    }

}
