<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Exception;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::all();
        return $users;
    }

    public function listVTUsers()
    {
        // if user has permision
        $user = Auth::user();
        $user_id = $user->id;
        $vtiger = new Vtiger();

        $cpUsers = User::Select('vtiger_contact_id')->get();
        $cpusersIdArr = array();

        foreach ($cpUsers as $cpuser) {
            array_push($cpusersIdArr, $cpuser->vtiger_contact_id);
        }

        //Get contact data of this user
        $userQuery = DB::table('Contacts')->select(
            'salutationtype',
            'firstname',
            'lastname',
            'email',
            'id'
        )->take(100);
        //->WhereNotIn('id', $cpUsers);
        $allContacts = $vtiger->search($userQuery)->result;
        $contacts = array();

        foreach ($allContacts as $contact) {
            if ($contact->id && $contact->email && !in_array($contact->id, $cpusersIdArr)) {
                array_push($contacts, $contact);
            }
        }

        return $contacts;
    }
    public function importVTUsers(Request $request)
    {
        $newUsers =  $request->newUsers;
        $newPassword = $request->newPassword;

        $userFullName = '';
        $existing = null;

        foreach ($newUsers as $new_user) {

            if ($new_user['salutationtype']) $userFullName = $new_user['salutationtype'];
            if ($new_user['firstname']) $userFullName .= ' ' . $new_user['firstname'];
            if ($new_user['lastname']) $userFullName .= ' ' . $new_user['lastname'];

            if ($new_user['email'] && $new_user['id']) { // in this case only be imported if has email
                $existing = User::where('email', $new_user['email'])->first();
                if (!$existing) {
                    User::create([
                        'name' => $new_user['firstname'],
                        'last_name' => $new_user['lastname'],
                        'vtiger_contact_id' => $new_user['id'],
                        'email' => $new_user['email'],
                        'description' => $userFullName,
                        'password' => Hash::make($newPassword),
                    ]);
                }
            }
        }
    }

    public function profile()
    {
        return view('users.index');
    }

    public function account()
    {
        $user = Auth::user();
        $vtiger = new Vtiger();
        //Get contact data of this user
        $userQuery = DB::table('Contacts')->select('*')->where("contact_no", $user->vtiger_contact_id)->take(1);
        $contact = $vtiger->search($userQuery)->result[0];

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
            $vtiger = new Vtiger();
            //Get contact data of this user
            $userQuery = DB::table('Contacts')->select('*')->where("contact_no", $request->contact_no)->take(1);
            $contact = $vtiger->search($userQuery)->result[0];

            $vtiger = new Vtiger();
            $obj = $vtiger->retrieve($contact->id);
            //Then update the object:
            $obj->result->secondaryemail = $request->secondaryemail;
            $obj->result->mobile = $request->mobile;
            $obj->result->cf_1945 = $request->cf_1945;
            $obj->result->cf_2254 = $request->cf_2254;
            $obj->result->cf_2246 = $request->cf_2246;
            $obj->result->cf_2252 = $request->cf_2252;
            $obj->result->cf_2250 = $request->cf_2250;
            $obj->result->user_donotcall = $request->user_donotcall;
            $obj->result->user_emailoptout = $request->user_emailoptout;

            $data = $vtiger->update($obj->result);
            return 200;
        } catch (Exception $e) {
            return response()->json("Error", 500);
        }
    }

    public function createUser(Request $request)
    {

        try {
            /*   $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->write($request);
            return $request; */

            User::create([
                'user_name' => $request->user,
                'vtiger_contact_id' =>  $request->cid,
                'password' => Hash::make($request->pass),
            ]);


            return response()->json('exitoso', 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function newPassword(Request $request)
    {

        $user = Auth::user();
        $vtiger = new Vtiger();
        //Get contact data of this user
        $userQuery = DB::table('Contacts')->select('*')->where("contact_no", $request->contact_no)->take(1);
        $contact = $vtiger->search($userQuery)->result[0];

        if ($request->old_password !== $contact->cf_1780) return 403;
        if ($request->new_password !== $request->confirm_password) return 403;

        $vtiger = new Vtiger();
        $obj = $vtiger->retrieve($contact->id);
        $obj->result->cf_1780 = $request->new_password;

        $data = $vtiger->update($obj->result);
        return 200;
    }
}
