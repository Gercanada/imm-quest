<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserCF;
use App\Models\UserSubDetail;
use Illuminate\Support\Facades\Hash;



use App\Mail\SendMail;
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
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        //with('contact_address')
        //->with('contact_details')
        //->with('contact_cf')
        //->with('contact_sub_details')
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
            $user = User::where('id', Auth::user()->id)
                ->with('contact_address')
                ->with('contact_details')
                //->with('contact_cf')
                ->with('contact_sub_details')
                ->firstOrFail();
            $anotherMail = false;


            if ($request->secondary_email) {
                $anotherMail = true;
            }


            $updateDetails = UserDetail::updateOrCreate(['contactid' =>  $user->id], [
                //'contactid'     => $user->id,
                'otheremail'     => $anotherMail,
                'secondaryemail' => $request->secondary_email,
                'mobile'         => $request->mobile_phone,
                'contact_no'     => $user->id,
                'lastname'       => $user->last_name ?? $request->last_name,
            ]);

            $updateCF = UserCF::updateOrCreate(['contactid' =>  $user->id]);
            $updateSub = UserSubDetail::updateOrCreate('contactsubscriptionid', $user->id);

            return 200;
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * This method is by vtier called as webservice to create user in CP DB
     */
    public function createUser(Request $request)
    {

        try {
             /*  $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->write($request);
            return $request; */

            User::create([
                'user_name' => $request->user,
                'vtiger_contact_id' =>  $request->cid,
                'password' => Hash::make($request->pass),
                'name'=>$request->firstname,
                'last_name'=>$request->lastname,
            ]);


            return response()->json('exitoso', 200);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function removeUser(Request $request)
    {

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function newPassword(Request $request)
    {
        return $request;
        //return view('auth.passwords.change-password');
    }
    public function newUserName(Request $request)
    {
        try {
            $user = Auth::user();

            if (User::where('alternative_username', $request->alternative_username)->firstOrFail()) {
                return 'Username already in use, try another';
            } else {
                $update = User::where('id', $user->id)->firstOrFail();
                $update->alternative_username = $request->alternative_username;
                $update->save();
            }
        } catch (\Exception $e) {
            return response()->json([$e, 500]);
        }
    }
}
