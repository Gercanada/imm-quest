<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Contact;
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
        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
        return $contact;
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
            $user = Auth::user();
            $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
            if ($contact->secondaryemail) {
                $contact->secondaryemail = $request->secondaryemail;
            }
            if ($contact->mobile) {
                $contact->mobile = $request->mobile;
            }
            if ($contact->cf_1945) {
                $contact->cf_1945 = $request->cf_1945;
            }
            if ($contact->cf_2254) {
                $contact->cf_2254 = $request->cf_2254;
            }
            if ($contact->cf_2246) {
                $contact->cf_2246 = $request->cf_2246;
            }
            if ($contact->cf_2252) {
                $contact->cf_2252 = $request->cf_2252;
            }
            if ($contact->cf_2250) {
                $contact->cf_2250 = $request->cf_2250;
            }
            if ($contact->user_donotcall) {
                $contact->user_donotcall = $request->user_donotcall;
            }
            if ($contact->user_emailoptout) {
                $contact->user_emailoptout = $request->user_emailoptout;
            }
            $contact->save();
            return 200;
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['UserController' => 'update']);
        }
    }

    public function createUser(Request $request) //Create user by ws from vt
    {
        try {
            $user =  User::updateOrCreate(
                ['vtiger_contact_id' =>  $request->cid],
                [
                    'user_name' => $request->user,
                    'name' =>  $request->firstname,
                    'last_name' =>  $request->lastname,
                    'email' =>  $request->email,
                    'password' => Hash::make($request->pass),
                ]
            );
            return $user ?: null;
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['UserController' => 'createUser']);
        }
    }

    public function newPassword(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
        if (!$contact) {
            return response()->json(['error' => 'Contact not found', 'code' => 404]);
            // return 404;
        }
        if ($request->old_password !== $contact->cf_1780) {
            return 403;
        }
        if ($request->new_password !== $request->confirm_password) {
            return 403;
        }

        $contact->cf_1780 = Hash::make($request->new_password);
        $contact->save();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return 200;
    }

    public function getThemme()
    {
        $user = Auth::user();
        if ($user) {
            return $user->themme_layout;
            // $newTheme = $user->themme_layout;
        }
        // return view('layouts.theme', compact('newTheme'));
    }
    public function setThemme(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $newTheme = $request->themme_layout;

        if ($user) {
            $user->themme_layout = $newTheme;
            $user->save();
        }
        return view('layouts.theme', compact('newTheme'));
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

        // return view('layouts.theme', compact('newTheme'));
    }
}