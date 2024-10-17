<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {

        // mostrar notas do usuario
        $id = session('user.id');
        // Este comando esta colocando dentro de $notes todas as notas relacionadas com users
        // EX: User busca todas as notas que estão relacionadas com este $id na tabela notes
        $notes = User::find($id)->notes()->get()->toArray();

        return view('home', ['notes'=>$notes]);

    }

    public function new_note(){
        echo 'new note';
    }












}
