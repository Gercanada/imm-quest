<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;

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
            return response()->json($e, 500);
            return response()->json(['error' => $e], 500);
        } else {
            return response()->json(['error' => $onMethod], 500);
        }
    }

    public function logsOnFile($msg, $onmethod)
    {
        $errors = [];
        $contents = file_get_contents(Storage::get('json_logs.json'));

        $obj = json_encode(
            [
                'error' => [
                    'just_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'method' => $onmethod,
                    'message' => $msg
                ]
            ]
        );
        array_push($errors, $obj);
        return Storage::put('json_logs.json', $errors);
    }
}

