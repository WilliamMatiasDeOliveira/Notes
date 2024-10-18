<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'username',
        'password',
    ];

    // coloco o nome do metodo com o mesmo nome da tabela que tem a chave estrangeira de users
    public function notes(){
        return $this->hasMany(Note::class);
    }
}
