<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function consoleWrite()
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        return $out;
    }

    public function returnJsonError($e, $onMethod)
    {
        if (env('APP_ENV') === 'local') {
            $this->consoleWrite()->writeln($e);
            return response()->json(['error' => $e], 500);
        } else {
            return response()->json(['error' => $onMethod]);
        }
    }
}
