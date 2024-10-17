<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    // coloco o nome do metodo com o mesmo nome do MODEL que estou sendo asossiado
    public function user(){
        return $this->belongsTo(User::class);
    }
}
