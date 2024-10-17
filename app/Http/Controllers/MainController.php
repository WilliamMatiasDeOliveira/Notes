<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

    public function new_note()
    {
       return view('new_note');
    }

    public function new_note_submit(){
        return view('new_note_submit');
    }

    public function edit($id)
    {
       try {
           $id = Crypt::decrypt($id);
       } catch (DecryptException $e) {
            return redirect('home');
       }

    }

    public function delete($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
             return redirect('home');
        }

        $user = User::find($id);
        User::deleted($user);

        return redirect('/');

    }










}
