<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Exception;

class UserController extends Controller
{
    public function profile()
    {
        return view('users.index');
    }

    public function users()
    {
        return response()->json(User::all());
    }
    public function account()
    {
        $user = Auth::user();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = User::Where('id', Auth::user()->id);

            if ($user->name) {
                $user->name = $request->name;
            }
            if ($user->last_name) {
                $user->last_name = $request->last_name;
            }
            $user->save();
            return 200;
            /*   if ($user->email) {
                $user->email = $request->email;
            } */
            /*  if ($user->user_name) {
                $user->user_name = $request->user_name;
            } */
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['UserController' => 'update']);
        }
    }



    public function newPassword(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        if ($request->new_password !== $request->confirm_password) {
            return 403;
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return 200;
    }

    public function getThemme()
    {
        $user = Auth::user();
        if ($user) {
            return $user->themme_layout;
        }
    }
    public function setThemme(Request $request)
    {
        $newTheme = $request->themme_layout;
        $user = User::where('id', Auth::user()->id)->firstOrFail();

        if ($user) {
            $user->themme_layout = $newTheme;
            $user->save();
        }
    }

    public function changeThemme(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $newTheme = $request->themme_layout;
        if ($user) {
            $newTheme = $user->themme_layout;
            $user->themme_layout = $newTheme;
            $user->save();
        }
    }
}
