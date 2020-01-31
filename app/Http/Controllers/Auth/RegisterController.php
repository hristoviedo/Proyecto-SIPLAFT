<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserValidation;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'adm.user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adm'); //Verifica que la solicitud proviene de un usuario registrado con el role de administrador.
        $this->middleware('active'); //Verifica que la solicitud proviene de un usuario activo.
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|integer|confirmed',
            'company_id' => 'required|integer|confirmed',
            'active' => 'required|boolean|confirmed',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|same:password|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect('adm.create.user')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            User::create([
                'name' => trim(mb_strtoupper($request['name'])),
                'email' => $request['email'],
                'role_id' => $request['role_id'],
                'company_id' => $request['company_id'],
                'active' => $request['active'],
                'password' => Hash::make($request['password']),
            ]);
            return back()->with('message', 'Usuario registrado'); //Retorna a la página anterior cuando registra al usuario
        }
    }
}
