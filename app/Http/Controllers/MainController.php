<?php

namespace App\Http\Controllers;

use App\Models\Note;
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

    public function new_note_submit(Request $request){
        $request->validate(
            // rules
            [
                'text_title'=>'required|min:3|max:200',
                'text_note'=>'required|min:3|max:3000',
            ],
            // messages
            [
                'text_title.required'=>'Este campo é obrigatório',
                'text_title.min'=>'O titulo tem que ter no minimo :min caractéres',
                'text_title.max'=>'O titulo tem que ter no maximo :max caractéres',

                'text_note.required'=>'Este campo é obrigatório',
                'text_note.min'=>'O texto tem que ter no minimo :min caractéres',
                'text_note.max'=>'O texto tem que ter no maximo :max caractéres'
            ]
        );

        // get user id
        $id = session('user.id');
        // create a new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

       return redirect()->route('home');

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
