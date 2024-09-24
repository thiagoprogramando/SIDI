<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    
    public function listUser(Request $request, $role = null) {

        $query = User::orderBy('name', 'asc');

        if($role) {
            $query->where('role', $role);
        }

        if(!empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if(!empty($request->phone)) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if(!empty($request->email)) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if(!empty($request->cpfcnpj)) {
            $query->where('cpfcnpj', 'like', '%' . $request->cpfcnpj . '%');
        }

        if(!empty($request->isento)) {
            $query->where('isento', $request->isento);
        }

        $users = $query->paginate(30);

        return view('app.user.list-user', [
            'users' => $users
        ]);
    }

    public function createUser(Request $request) {

        $validatedData = $request->validate([
            'email'     => 'required|email|unique:users,email',
        ], [
            'email.required' => 'O campo e-mail é obrigatório!',
            'email.email'    => 'Informe um endereço de e-mail válido!',
            'email.unique'   => 'Este e-mail já está cadastrado!',
        ]);

        $user            = new User();
        $user->name      = $request->name;
        $user->cpfcnpj   = preg_replace('/\D/', '', $request->cpfcnpj);
        $user->phone     = preg_replace('/\D/', '', $request->phone);
        
        if($request->postal_code) {
            $user->postal_code = preg_replace('/\D/', '', $request->postal_code);
        }
        if($request->num) {
            $user->num = $request->num;
        }
        if($request->address) {
            $user->address = $request->address;
        }
        if($request->state) {
            $user->state = $request->state;
        }
        if($request->city) {
            $user->city = $request->city;
        }
        
        if($request->isento == 'on') {
            $user->isento = 1;
        } else {
            $user->isento = 0;
        }

        $user->role      = $request->role;
        $user->email     = $request->email;
        $user->password  = bcrypt($request->password);
        if($user->save()) {
            return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível cadastrar o usuário!');
    }

    public function updateUser(Request $request) {

        $validatedData = $request->validate([
            'id'     => 'required',
        ], [
            'email.required' => 'Nenhum usuário selecionado!',
        ]);

        $user            = User::find($request->id);
        if(!$user) {
            return redirect()->back()->with('error', 'Não foi possível encontrar dados do usuário!');
        }

        if($request->name) {
            $user->name = $request->name;
        }
        if($request->cpfcnpj) {
            $user->cpfcnpj = preg_replace('/\D/', '', $request->cpfcnpj);
        }
        if($request->phone) {
            $user->phone = preg_replace('/\D/', '', $request->phone);
        }
        if($request->postal_code) {
            $user->postal_code = preg_replace('/\D/', '', $request->postal_code);
        }
        if($request->num) {
            $user->num = $request->num;
        }
        if($request->address) {
            $user->address = $request->address;
        }
        if($request->state) {
            $user->state = $request->state;
        }
        if($request->city) {
            $user->city = $request->city;
        }
        if($request->isento == 'on') {
            $user->isento = 1;
        } else {
            $user->isento = 0;
        }
        if($request->role) {
            $user->role = $request->role;
        }
        if($request->email) {
            $user->email = $request->email;
        }
        if($request->password) {
            $user->password = bcrypt($request->password);
        }

        if($user->save()) {
            return redirect()->back()->with('success', 'Usuário atualizado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível atualizar o usuário!');
    }

    public function deleteUser(Request $request) {

        $user = User::find($request->id);
        if($user && $user->delete()) {
            return redirect()->back()->with('success', 'Usuário excluído com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possível excluir o usuário!');
    }

}
