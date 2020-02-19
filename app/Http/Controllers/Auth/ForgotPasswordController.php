<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    // Comentamos esto que no nos hace falta
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // Añadimos las respuestas JSON, ya que el Frontend solo recibe JSON
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        switch ($response) {
            case \Password::INVALID_USER:
                return response()->error($response, 422);
                break;

            case \Password::INVALID_PASSWORD:
                return response()->error($response, 422);
                break;

            case \Password::INVALID_TOKEN:
                return response()->error($response, 422);
                break;
            default:
                return response()->success($response, 200);
        }
    }
}
