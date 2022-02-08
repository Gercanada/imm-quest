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

    public function users(){
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
            $contact->secondaryemail = $request->secondaryemail;
            $contact->mobile = $request->mobile;
            $contact->cf_1945 = $request->cf_1945;
            $contact->cf_2254 = $request->cf_2254;
            $contact->cf_2246 = $request->cf_2246;
            $contact->cf_2252 = $request->cf_2252;
            $contact->cf_2250 = $request->cf_2250;
            $contact->donotcall = $request->user_donotcall;
            $contact->emailoptout = $request->user_emailoptout;

            $contact->save();
            return 200;
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    public function createUser(Request $request) //Create user by ws from vt
    {
        try {
           $user =  User::updateOrCreate(
                ['vtiger_contact_id' =>  $request->cid],
                [
                    'user_name' => $request->user,
                    'name' =>  $request->first_name,
                    'last_name' =>  $request->last_name,
                    'email' =>  $request->email,
                    'password' => Hash::make($request->pass),
                ]
            );
            return $user;
            //return response()->json('exitoso', 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function newPassword(Request $request)
    {


        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        $out->writeln("AT userController");
        $out->writeln($request);


        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $contact = Contact::where("contact_no", $user->vtiger_contact_id)->firstOrFail();
        if (!$contact) return 404;
        if ($request->old_password !== $contact->cf_1780) return 403;
        if ($request->new_password !== $request->confirm_password) return 403;

        $contact->cf_1780 = Hash::make($request->new_password);
        $contact->save();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return 200;
    }

    public function getThemme()
    {
        $user = Auth::user();
        return $user->themme_layout;
    }
    public function setThemme(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->firstOrFail();
        $user->themme_layout = $request->themme_layout;
        $user->save();
    }
}
