<?php

namespace App\Http\Controllers;

use App\Models\Commboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;

class CommboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendComment(Request $request)
    {
        try {
            $user = Auth::user();
            $user_id = $user->id;

            $vtiger = new Vtiger();
            //Get contact data of this user
            $userQuery = DB::table('Contacts')->select('*')->where("contact_no", $user->vtiger_contact_id)->take(1);
            $contact = $vtiger->search($userQuery)->result[0];
            //return $contact;
            $vtiger = new Vtiger();
            $data = [
                "assigned_user_id"=> "19x29",
                'cf_2218' => $request->threadid, //threadid
                'cf_2224' => "$contact->firstname $contact->lastname",
                'description' => $request->comment
            ];

            $any = [];
            /* $newComment = */ array_push($any, json_encode($data));

            //return $newComment;
            $data = $vtiger->create( "CommBoard", $data);
            //$data = $vtiger->create( $MODULE_NAME, json_encode( $data ) );

            return redirect('/');
        } catch (\Exception $e) {
            return $e;
        }
    }
}
