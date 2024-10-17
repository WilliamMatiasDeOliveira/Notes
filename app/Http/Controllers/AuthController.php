<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Builder\Use_;

class AuthController extends Controller
{

    public function login()
    {
        if(session('user')){
            return redirect('/');
        }
        // return view('login');
        return response()
        ->view('login')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

    public function login_submit(Request $request)
    {
        $request->validate(
            // rules
            [
                'text_username' => 'required|string',
                'text_password' => 'required|min:6|max:16'
            ],
            // messages
            [
                'text_username.required' => 'Este campo é obrigatório',
                'text_password.required' => 'Este campo é obrigatório',
                'text_password.min' => 'A senha deve ter no mínimo :min caracteres',
                'text_password.max' => 'A senha deve ter no máximo :max caracteres'
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // verifica se existe este user cadastrado
        $user = User::where('username', $username)
                        ->where('deleted_at', NULL)
                        ->first();

        if (!$user) {
            $msg = 'Usuário ou senha inválidos';
            return redirect('login')
                ->withInput()
                ->with('login_error', $msg);
        }

        if (!password_verify($password, $user->password)) {
            $msg = 'Usuário ou senha inválidos';
            return redirect('login')
                ->withInput()
                ->with('login_error', $msg);
        }

        $user->last_login = now();
        $user->save();

        session([
            'user'=>[
                'id'=>$user->id,
                'username'=>$user->username
            ]
        ]
        );

        // redirect to home
        return redirect('/');


    }

    public function create_account(){
        return view('create_account');
    }

    public function check_account(Request $request)
    {
        $request->validate(
            // rules
            [
                'create_username' => 'required|string',
                'create_password' => 'required|min:6|max:16',
                'confirm_password' => 'required|same:create_password|min:6|max:16'
            ],
            // messages
            [
                'create_username.required' => 'Este campo é obrigatório',
                'create_password.required' => 'Este campo é obrigatório',
                'create_password.min' => 'A senha deve ter no mínimo :min caracteres',
                'create_password.max' => 'A senha deve ter no máximo :max caracteres',
                'confirm_password.required' => 'É necessário confirmar a senha',
                'confirm_password.same' => 'As senhas devem ser iguais',
                'confirm_password.min' => 'A senha de confirmação deve ter no mínimo :min caracteres',
                'confirm_password.max' => 'A senha de confirmação deve ter no máximo :max caracteres',
            ]
        );

        $username = $request->input('create_username');
        $password = $request->input('create_password');

        // verifica se já existe este user cadastrado
        $user = User::where('username', $username)
            ->first();

        // se já existir
        if ($user) {
            $msg = 'Este usúario já existe';
            return redirect('create_account')
                ->withInput()
                ->with('create_error', $msg);
        }

        // se não existir
        User::create(
            [
                'username' => $username,
                'password' => Hash::make($password),
                'created_at' => date('Y-m-d H:i:s')
            ]
        );

        $msg = 'Usuário cadastrado com sucesso';
        return redirect('login')->with('success', $msg);
    }

    public function logout()
    {
        session()->forget('user');
        return redirect('login');
    }
}
