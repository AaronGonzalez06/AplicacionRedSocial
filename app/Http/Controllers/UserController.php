<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function config() {
        return view('user.config');
    }

    public function password() {
        return view('user.password');
    }

    public function update_password(Request $request) {

        $user = \Auth::user();
        $id = $user->id;

        /* $validate = $this->validate($request, [
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required|string|min:6|confirmed',
          ]); */
        //meter datos del furmulario en variables
        $current_pass = $request->input('Current_password');
        $pass = $request->input('password');
        $pass_con = $request->input('password_confirmation');
        //verificar contraseña del usuario
        if (password_verify($current_pass, $user->password)) {

            //verificar si son iguales
            if ($pass == $pass_con) {

                $cifrado = Hash::make($pass);

                $user->password = $cifrado;
                $user->update();
                return redirect()->route('user.password')
                                ->with(['message' => 'Contraseña actualizado.']);
            }
        }
        return redirect()->route('user.password')
                        ->with(['message' => 'error con la actualizado.']);
    }

    public function update(Request $request) {

        //conseguir id
        $user = \Auth::user();
        $id = $user->id;

        //validar datos
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);
        //recoger los datos
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //asignar nuevos valores
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir imagen
        $image_path = $request->file('image_path');
        if ($image_path) {
            //poner nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();

            //guardar en la carpeta
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //asignar
            $user->image = $image_path_name;
        }

        //ejecutar consulta y update
        $user->update();

        return redirect()->route('config')
                        ->with(['message' => 'Usuario actualizado.']);
    }

    public function getImage($filename) {
        $file = storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    
    public function profile($id){
        $user = User::find($id);
        
        return view('user.profile',[
            'user' => $user
        ]);
        
    }
    
    public function index($search = null){
        
        if(!empty($search)){
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                    ->orderBy('id','desc')
                    ->paginate(5);
        }else{            
            $users = User::orderBy('id','desc')->paginate(5);            
        }
        
        
        
        
        return view('user.index',[
            'users' => $users
        ]);
    }

}
