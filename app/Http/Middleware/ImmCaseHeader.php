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
        $vtiger = new Vtiger();

        $headers = \Request::header();
        $agentId = $headers['userid'][0];
        $user = null;
        //dd($agentId);
        $userQuery = DB::table('Users')->select('id', 'is_admin', 'user_name', 'email1')->where("id", (string)$agentId)->take(1);
        $user1 = $vtiger->search($userQuery);

        if ($user1->success === true) {
            if (count($user1->result) > 0) {
                $user = $user1->result[0];
            }
            if (!$user) {
                return response()->json("User not found as IMMcase user", 403);
            }
        } else {
            return response()->json("Invalid agent id"+ $agentId, 403);
        }
        $response = $next($request);

        return $response;
    }
}
