<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function login(Request $request) {
        $userDados = $request->validate([
            'logemail' => 'required',
            'logpwd' => 'required'
        ]);

        if (auth()->attempt(['email' => $userDados['logemail'], 'password' => $userDados['logpwd']])) {
            $request->session()->regenerate();
            return redirect('/');
        } else {
            return back()->withErrors(['logemail' => 'Credenciais incorretas.']);
        }
    }

    public function registrar(Request $request) {
        $userRequest = $request->validate([
            'nome' => ['required', 'min:5', 'max:50', Rule::unique('users', 'nome')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'user_tipo' => ['required', Rule::in(['usr', 'adm'])]
        ]);

        if ($userRequest['user_tipo'] == 'adm') {
            $request->validate([
                'senha_controle' => 'required',
            ]);
    
            $senhaDeControle = env('SUPER_SENHA');
    
            if ($request->input('senha_controle') !== $senhaDeControle) {
                return back()->withErrors(['senha_controle' => 'Senha de controle inválida. Entre em contato com um admin.']);
            }
        }

        $userRequest['password'] = bcrypt($userRequest['password']);
        $user = User::create($userRequest);
        auth()->guard()->login($user);
        return redirect('/');
    }

    public function logout(){
        auth()->guard()->logout();
        return redirect('/');
    }
    
    public function editar($id){
        $usuario = User::find($id);
        return view('editar', ['usuario' => $usuario]);
    }

    public function atualizar(Request $request, $id){
        $usuario = User::find($id);
        $validatedData = $request->validate([
            'nome' => 'required|min:5|max:50',
            'email' => 'required|email',
            'password' => 'nullable|min:5|max:20',  
        ]);

        $usuario->nome = $validatedData['nome'];
        $usuario->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $usuario->password = bcrypt($validatedData['password']);
        }

        if (auth()->user()->user_tipo == 'adm') {
            $usuario->user_tipo = $request->input('user_tipo');  
        }

        $usuario->save();
        return redirect('/')->with('message', 'Usuário atualizado com sucesso!');
    }

    public function deletar($id){
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect('/')->with('message', 'Usuário deletado com sucesso!');
    }

}