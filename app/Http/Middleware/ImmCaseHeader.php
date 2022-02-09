<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JBtje\VtigerLaravel\Vtiger;
use Response;

class ImmCaseHeader
{
    /**
     * Handle an incoming request.
     *In this middleware we make sure that web services are requested only by users registered in immcase
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //$vtiger = new Vtiger();
        $headers = \Request::header();
        $agentId = $headers['userid'][0];
        $immcase_pass = $headers['immcasepass'][0];

        if (password_verify('GER_immcase22', $immcase_pass)) {
            $response = $next($request);
        } else {
            $response = response()->json("Invalid immcase authorization");
        }
        return $response;

        /* $user = null;

        $userQuery = DB::table('Users')->select('*')->where("id", "19x$agentId")->take(1);
        $user1 = $vtiger->search($userQuery);

        if ($user1->success === true) {
            if (count($user1->result) > 0) {
                $user = $user1->result[0];
            }
        }
        if (!$user) {
            return response()->json(["User not found as IMMcase user"=>$headers], 403);
        }
        $response = $next($request); */
    }
}

/*
    vtiger middleware
    Asegurar que el header venga de immcase
    -> Puede ser llamada por un usuario (iniciarmanualmente, etc ...)
    ->como webservice ()

*/
