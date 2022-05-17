<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['El email no existe o no coincide con nuestros datos.'],
            ]);
        }

        if ($user && !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Contraseña invalida'],
            ]);
        }

        return response()->json(
            ['token' => $user->createToken($request->device_name)->plainTextToken]
        );
    }
}
