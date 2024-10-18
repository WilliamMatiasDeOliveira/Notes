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
        $notes = User::find($id)
                        ->notes()
                        ->where('deleted_at', NULL)
                        ->get()
                        ->toArray();

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

        $msg = 'Nota inserida com sucesso !';
        return redirect()->route('home')->with('new_note_success', $msg);

    }

    public function edit($id)
    {
       $id = $this->decrypt($id);
    //    buscar a nota a ser editada
       $note = Note::find($id);
    // carregar a nota a ser editada
       return view('edit', ['note'=>$note]);

    }

    public function edit_submit(Request $request)
    {
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
        // check if note_id exist
        if(!$request->note_id){
            return redirect()->route('home');
        }
        // decrypt note_id
        $id = decrypt($request->note_id);
        // carregar a nota
        $note = Note::find($id);
        // atualizar a nota
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();
        // redirect to home
        $msg = 'Nota editada com sucesso';
        return redirect()->route('home')->with('edit_success', $msg);






    }

    public function delete($id)
    {
        // captura o id e devolve desencriptado
        $id = $this->decrypt($id);
        // carregar a nota a ser deletada
        $note = Note::find($id);
        // mostrar delete_confirm
        return view('delete_note', ['note'=>$note]);

    }

    public function delete_confirm($id)
    {
        $id = $this->decrypt($id);
        // carregar a nota
        $note = Note::find($id);

        // HARD DELETE
        // $note->delete();

        // SOFT DELETE
        $note->deleted_at = date('Y-m-d H:i:s');
        $note->save();

        $msg = 'Nota deletada com sucesso !';
        return redirect()->route('home')->with('delete_success', $msg);

    }

    // função privada para desencryptar o id
    private function decrypt($id)
    {
        try {
            // captura o id e devolve desencriptado
               $id = Crypt::decrypt($id);
           } catch (DecryptException $e) {
                return redirect()->route('home');
           }
           return $id;
    }










}
