<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function login_submit(Request $request){
        echo 'submit';
    }

    public function check_account(Request $request){
        $request->validate(
            // rules
            [
                'text_username' => 'required|string',
                'text_password' => 'required|min:6|max:16',
                'confirm_password' => 'required|same:text_password|min:6|max:16'
            ],
            // messages 
            [
                'text_username.required' => 'Este campo é obrigatório',
                'text_password.required' => 'Este campo é obrigatório',
                'text_password.min' => 'A senha deve ter no mínimo :min caracteres',
                'text_password.max' => 'A senha deve ter no máximo :max caracteres',
                'confirm_password.required' => 'É necessário confirmar a senha',
                'confirm_password.same' => 'As senhas devem ser iguais',
                'confirm_password.min' => 'A senha de confirmação deve ter no mínimo :min caracteres',
                'confirm_password.max' => 'A senha de confirmação deve ter no máximo :max caracteres',
            ]
        );
    }
    












}
