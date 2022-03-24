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
        $newArr = [];
        if (env('APP_ENV') === 'local') {
            $this->consoleWrite()->writeln("!! ERROR $onMethod[0] -> $onMethod[1]");
            $this->consoleWrite()->writeln($e->getMessage());
            $this->consoleWrite()->writeln($e);
            array_push($newArr, $onMethod, [
                'message' => $e->getMessage(),
                'details' => $e
            ]);
            return response()->json(['error' => $newArr], 500);
        } else {
            //array_push($omMethod, $e->getMessage());            
            array_push($newArr, $onMethod, [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['error' => $newArr], 500);
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
