<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\CPCase;
use App\Models\Checklist;
use App\Models\CLItem;
use Illuminate\Http\Request;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use  \org\jsonrpcphp\JsonRPCClient as JsonRPCClient;
use Exception;

class LSurveyController extends Controller
{
    public function index()
    {
        /* List surveys thath user has access */
        // return $limeConnection['groups'];
        $limeConnection = self::connectLime();
        $sSessionKey = $limeConnection['sessionKey'];
        $iSurveyID = '1000';
        return base64_decode($limeConnection['myJSONRPCClient']->export_responses_by_token($sSessionKey, $iSurveyID));
    }

    /**
     * it function be called from immcase as webservice
     * it be create access key for contact and send guest email.
     * the help link was be updated in clitem record and then be updated on cp
     * ->ensure thath clitem is questionarie
     */
    public function guestToSurvey(Request $request)
    {
        try {
            $vtiger       = new Vtiger();
            $task         = new CloneDBController;
            $contact      = Contact::where('contact_no', $request->contact_no)->firstOrFail();
            $iSurveyID    = $request->survey_id;
            $token        = 'ABCDE';
            $email        = $contact->email;
            $LastNameAPI  = $contact->lastname;
            $FirstNameAPI = $contact->firstname;

            $limeConnection  = self::connectLime(); //Start limesurvey session
            $myJSONRPCClient = $limeConnection['myJSONRPCClient'];
            $sSessionKey     = $limeConnection['sessionKey'];
            // Define the token params
            $tokenParams = array(
                "email"       => $email,
                "lastname"    => $LastNameAPI,
                "firstname"   => $FirstNameAPI,
                "token"       => $token,
                // "language"    => 'es-MX',
                "emailstatus" => "OK"
            );

            $aParticipantData = array($tokenParams);
            $bCreateToken = true;
            // Create the tokens
            $newToken = $myJSONRPCClient->add_participants($sSessionKey, $iSurveyID, $aParticipantData, $bCreateToken);
            // return $newToken[0]['token'];
            if (array_key_exists("status", $newToken)) { // If catched survey error starus
                return response()->json(["error" => [$newToken, $sSessionKey]]);
            } else {
                $tokenIDs = array($newToken[0]['tid']);
                $newMail = $myJSONRPCClient->invite_participants($sSessionKey, $iSurveyID, $tokenIDs, true);
                // Print returned results

                //  return $newToken;
                $surveyValues = [];
                // if ($newMail[$newToken[0]['tid']]['status'] == 'OK') {
                array_push(
                    $surveyValues,
                    $iSurveyID,
                    $newToken[0]['token'],
                    $newToken[0]['tid'],
                    $newToken[0]['language']
                );
                // }
                // return $surveyValues;

                $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $request->clitemsno)->take(1);
                $clitem = $vtiger->search($clitemQuery);

                if ($clitem->success) {
                    $clitem =  $vtiger->search($clitemQuery)->result[0];
                    $obj = $vtiger->retrieve($clitem->id);
                    $obj->result->cf_1212 = $limeConnection['lime_connection']['LS_BASEURL'] . '/' . $surveyValues[0] . "?token=" . $surveyValues[1] . "&lang=" .  "en"; //help link
                    $obj->result->cf_acf_rtf_1208 = "This clitem is a questionaire";
                    $vtiger->update($obj->result);
                    //return [$clitem, $obj];
                    $task->updateCLItemFromImmcase($request);
                    $request->request->add(['checklist_id' => $obj->result->cf_1216]);  // Add value to request
                    $task->updateChecklistFromImmcase($request); //checklist of clitem be updated
                }
                // Release the session key
                $myJSONRPCClient->release_session_key($sSessionKey);
                return response()->json(["success" => "Gest sent !"]);
                //return response()->json(["success" => $surveyValues]);
            }
        } catch (Exception $e) {
            // return $e;
            return $this->returnJsonError($e, ['LSurveyController' => 'guestToSurvey']);
        }
    }

    /**
     * this method is called as button request
     * it checks if a survey of clitem was answered
     * if true, the clitem be updated (inly takes submitdate for this case)
     */
    public function exportResponse(Request $request)
    {
        try {
            $vtiger      = new Vtiger();
            $task        = new CloneDBController;
            $docsTask    = new DocumentController();
            $clitemTask  = new CLItemController();
            $now         = Carbon::now()->format('H:i:s');

            if (env('APP_ENV') === 'local') {
                $this->consoleWrite()->writeln("Called exportResponse method ");
                $this->consoleWrite()->writeln("Here we go 1");
                $this->consoleWrite()->write($request);
            }

            if ($request->form != 'vue') {
                $request->form = '';
            }
            if ($request->survey_url) {
                $oncpItem = CLItem::where("cf_1212", "like", "%" . $request->survey_url . "%")->firstOrFail();
                $clitemQuery = DB::table('CLItems')->select('*')->where("cf_1212", "like", "%" . $request->survey_url . "%")->take(1);
            } else {
                $oncpItem = CLItem::where("clitemsno", $request->clitemsno)->firstOrFail();
                $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $request->clitemsno)->take(1);
            }

            /* Find clitem of current survey */
            $clitem = $vtiger->search($clitemQuery);


            if ($clitem->success === false || empty($clitem->result)) {
                return response()->json("Item not found", 404);
            } else {
                $clitem =  $clitem->result[0];
            }

            if ($clitem->cf_1212 != $oncpItem->cf_1212) {
                $task->updateCLItemFromImmcase($request);
                $clitem = $vtiger->search($clitemQuery)->result[0];
            }

            $request->request->add(['clitemsno' => $clitem->clitemsno]);

            $checklist = Checklist::where('id', $clitem->cf_1216)->firstOrFail();
            $contact   = Contact::where('id', $clitem->cf_contacts_id)->firstOrFail();
            $case      = CPCase::where('id', $clitem->cf_1217)->firstOrFail();

            $request->request->add(['checklist_id' => $clitem->cf_1216]);

            $urlObj = parse_url($clitem->cf_1212);
            $iSurveyID = str_replace('/', '', $urlObj['path']);
            $urlQuery = $urlObj['query'];
            $urlQueryAsArr = [];

            parse_str($urlQuery,  $urlQueryAsArr);
            $sToken = $urlQueryAsArr['token'];

            $limeConnection = self::connectLime(); //Start limesurvey session


            $myJSONRPCClient = $limeConnection['myJSONRPCClient'];
            $sSessionKey = $limeConnection['sessionKey'];

            $exportSurvey = $myJSONRPCClient->export_responses_by_token( //as json
                $sSessionKey,
                $iSurveyID,
                $sDocumentType = 'json',
                $sToken,
                $sLanguageCode = null,
                $sCompletionStatus = 'complete',
                $sHeadingType = null,
                $sResponseType = 'short',
                $aFields = null
            );

            $exportSurveyAsPDF = $myJSONRPCClient->export_responses_by_token( //as pdf
                $sSessionKey,
                $iSurveyID,
                $sDocumentType = 'pdf',
                $sToken,
                $sLanguageCode = null,
                $sCompletionStatus = 'complete',
                $sHeadingType = 'full',
                $sResponseType = 'long',
                $aFields = null
            );

            $natdirectory = "/public/documents/contact/$contact->contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/" . $clitem->clitemsno . '-' . $clitem->cf_1200;
            $directory = str_replace(" ", "_", $natdirectory);

            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory); //creates directory if not exists
            }
            /* Download base64encoded responses as file */
            if (is_string($exportSurvey)) {
                $surveyResults = json_decode(base64_decode($exportSurvey));
                $surveyResponses =  $surveyResults->responses;
                $file = str_replace(' ', '_', $clitem->name);
                $file = $file . '.pdf';

                if ($surveyResponses[0]->submitdate != null) {
                    if (!Storage::exists($directory . '/' . $file)) {
                        if (env('APP_ENV') === 'local') {
                            self::download('', '../storage/app/' . $directory . '/' . $file, $exportSurveyAsPDF); //save survey file on storage folder
                        } else {
                            self::download('', './storage/app/' . $directory . '/' . $file, $exportSurveyAsPDF); //save survey file on storage folder
                        }
                    }
                    if (Storage::exists($directory . '/' . $file)) {
                        if (env('APP_ENV') === 'local') {
                            $this->consoleWrite()->writeln("just here");
                        }
                        $obj = $vtiger->retrieve($clitem->id);

                        $request->request->add(['cid'       => $contact->contact_no]);
                        $request->request->add(['case'      => $case->ticket_no . '-' . $case->ticketcategories]);
                        $request->request->add(['checklist' => $checklist->checklistno . '-' . $checklist->cf_1706]);
                        $request->request->add(['clitem'    => $clitem->clitemsno . '-' . $clitem->cf_1200]);

                        $files =  $docsTask->checkDocuments($request);

                        $succesStatus = false;
                        $driveFilePath = '';
                        $filePaths = [];
                        $newFilePath =  str_replace(" ", "_", "$contact->cf_1332/$contact->contact_no/$contact->contact_no-cases/$case->ticket_no-$case->ticketcategories/01_SuppliedDocs");
                        $driveTask = new ClitemController();
                        $toDrive = $driveTask->putInDrive($newFilePath, $files[0]);
                        $succesStatus = $toDrive[0];
                        $driveFilePath = $toDrive[1];

                        $filesUrls = $files[1];

                        $updatedItem =  $clitemTask->updateUploadedItem(
                            $vtiger,
                            $clitem->id,
                            $succesStatus,
                            $now,
                            $driveFilePath,
                            $newFilePath,
                            $task,
                            $docsTask,
                            $filesUrls,
                            $request
                        );
                        return $updatedItem;
                    }
                }
            }
            // Release the session key
            $myJSONRPCClient->release_session_key($sSessionKey);
            return 'success';
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['LSurveyController' => 'exportResponse']);
        }
    }


    public function survey(Request $request, $id)
    {
        $user      = Auth::user();
        $vtiger    = new Vtiger();
        $task      = new CloneDBController;
        $contact   = Contact::where('contact_no',  $user->vtiger_contact_id)->firstOrFail();
        $oncpItem  =   CLItem::where('id', $id)->where('cf_contacts_id', $contact->id)->firstOrFail();
        //$oncpItem = CLItem::where("clitemsno", $request->clitemsno)->firstOrFail();
        /* Find clitem of current survey */
        $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $oncpItem->clitemsno)->take(1);
        $clitem = $vtiger->search($clitemQuery);

        if ($clitem->success === false) {
            if (env('APP_ENV') === 'local') {
                $this->consoleWrite()->writeln('error at 302');
            }
            return response()->json("Item not found", 404);
        }

        $clitem =  $clitem->result[0];

        if ($clitem->cf_1212 != $oncpItem->cf_1212) {
            $request->request->add(['clitemsno' => $clitem->clitemsno]);
            $task->updateCLItemFromImmcase($request);
            $clitem = $vtiger->search($clitemQuery);
        }

        //limesurvey connection
        $urlObj = parse_url($clitem->cf_1212);
        $iSurveyID = str_replace('/', '', $urlObj['path']);

        $urlQuery = $urlObj['query'];
        $urlQueryAsArr = [];

        parse_str($urlQuery,  $urlQueryAsArr);
        $sToken = $urlQueryAsArr['token'];

        $limeConnection = self::connectLime(); //Start limesurvey session
        $myJSONRPCClient = $limeConnection['myJSONRPCClient'];
        $sSessionKey = $limeConnection['sessionKey'];

        $exportSurvey = $myJSONRPCClient->export_responses_by_token( //as json
            $sSessionKey,
            $iSurveyID,
            $sDocumentType = 'json',
            $sToken,
            $sLanguageCode = null,
            $sCompletionStatus = 'complete',
            $sHeadingType = null,
            $sResponseType = 'short',
            $aFields = null
        );

        $surveyResponses = [];
        if (is_string($exportSurvey)) {
            $surveyResults = json_decode(base64_decode($exportSurvey));
            $surveyResponses =  $surveyResults->responses;
        }

        return  $surveyResponses;
        // return [$clitem, $surveyResponses];
    }

    /**
     * This function is callen when requires starts a limesurvey remotecontrol session
     */
    static function connectLime()
    {
        //TODO Check if release sesion key causes an error
        $limeConnection = [
            'LS_RPCURL'   => env('LS_RPCURL'),
            'LS_BASEURL'  => env('LS_BASEURL'),
            'LS_USER'     => env('LS_USER'),
            'LS_PASSWORD' => env('LS_PASSWORD') //TODO check issues
        ];
        $myJSONRPCClient = new JsonRPCClient(env('LS_RPCURL'));
        $sessionKey = $myJSONRPCClient->get_session_key(env('LS_USER'), env('LS_PASSWORD'));

        $groups = $myJSONRPCClient->list_surveys($sessionKey);
        // release the session key
        //$myJSONRPCClient->release_session_key($sessionKey);
        return [
            'myJSONRPCClient' => $myJSONRPCClient,
            'sessionKey'      => $sessionKey,
            'lime_connection' => $limeConnection,
            'groups'          => $groups,
        ];
    }



    /***
     * Downloads base64 encoded file
     *
     * @param string $filename The filename the users will see
     * @param string $filepath The file path with filename where file_put_contents() will write to
     * For example: '/path/to/be/written/your-file.pdf'. Here the directory must be writable
     *
     * @param string $base64_encoded_file_data The base64 encoded data
     * @return void
     * @font : https://gist.github.com/unclexo/c0a54d9c6c1e7b58c978e7bb7955db02
     */

    static function download($filename, $filepath, $base64_encoded_file_data)
    {
        // Prevents run-out-of-memory issue
        if (ob_get_level()) {
            ob_end_clean();
        }
        // Decodes encoded data
        $decoded_file_data = base64_decode($base64_encoded_file_data);
        // Writes data to the specified file
        file_put_contents($filepath, $decoded_file_data);
        header('Expires: 0');
        header('Pragma: public');
        header('Cache-Control: must-revalidate');
        header('Content-Length: ' . filesize($filepath));
        header('Content-Type: application/octet-stream');
        /* header('Content-Disposition: attachment; filename="' . $filename . '"');
           readfile($filepath);
           // Deletes the temp file
           if (file_exists($filepath)) {
            unlink($filepath);
          }*/
    }

    /**
     * It method be automatic called at sbmit a survey by an participant
     */
    public function onSubmit(Request $request, $id, $tkn, $ln)
    {
        try {
            $link = "forms.gercanada.com/$id?token=$tkn";
            if (env('APP_ENV') === 'local') {
                $this->consoleWrite()->writeln("Called onSubmit method ");
            }

            $request->request->add(['survey_url' => $link]);
            $task = new LSurveyController();
            $exported = $task->exportResponse($request);

            if ($exported === 'Success') {
                // return view('checklists.items.survey.done');
                return redirect('/submittedsurvey');
            }
            return $exported;
        } catch (Exception $e) {
            return $this->returnJsonError($e, ['LSurveyController' => 'onSubmit']);
        }
    }

    public function submitted()
    {
        return view('checklists.items.survey.done');
    }
}


/*   http: //forms.gercanada.com/1000?token=H1AC0X6X6eanyYy&lang=en
        http: //forms.gercanada.com/{SAVEDID}?token={TOKEN}&lang={LANG}
        https: //70b6-187-212-180-149.ngrok.io/submitsurvey/helplink/http://forms.gercanada.com/{SAVEDID}?token={TOKEN}&lang={LANG}
         https: //70b6-187-212-180-149.ngrok.io/submitsurvey/id{SAVEDID}/tkn/{TOKEN}/ln/{LANG} */