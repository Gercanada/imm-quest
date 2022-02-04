<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\CPCase;
use App\Models\Checklist;
use Illuminate\Http\Request;
use  \org\jsonrpcphp\JsonRPCClient as JsonRPCClient;
use JBtje\VtigerLaravel\Vtiger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Exception;

class LSurveyController extends Controller
{
    public function index()
    {
        /* List surveys thath user has access */
        $limeConnection = self::connectLime();
        // return $limeConnection['groups'];
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
            $contact      = Contact::where('contact_no', $request->contact_no)->firstOrFail();
            $iSurveyID    = $request->survey_id;
            $token        = 'ABCDE';
            $email        = $contact->email;
            $LastNameAPI  = $contact->lastname;
            $FirstNameAPI = $contact->firstname;

            $limeConnection = self::connectLime(); //Start limesurvey session
            $myJSONRPCClient = $limeConnection['myJSONRPCClient'];
            $sSessionKey = $limeConnection['sessionKey'];

            // Define the token params
            $tokenParams = array(
                "email" => $email,
                "lastname" => $LastNameAPI,
                "firstname" => $FirstNameAPI,
                "token" => $token,
                "language" => 'en',
                "emailstatus" => "OK"
            );

            $aParticipantData = array($tokenParams);
            $bCreateToken = true;
            // Create the tokens
            $newToken = $myJSONRPCClient->add_participants($sSessionKey, $iSurveyID, $aParticipantData, $bCreateToken);
            if (array_key_exists("status", $newToken)) { // If catched survey error starus
                return response()->json(["error" => [$newToken, $sSessionKey]]);
            } else {
                $tokenIDs = array($newToken[0]['tid']);
                $newMail = $myJSONRPCClient->invite_participants($sSessionKey, $iSurveyID, $tokenIDs, true);
                // Print returned results
                $surveyValues = [];

                if ($newMail[$newToken[0]['tid']]['status'] == 'OK') {
                    array_push(
                        $surveyValues,
                        $iSurveyID,
                        $newToken[0]['token'],
                        $newToken[0]['tid']
                    );
                }

                $clitemQuery = DB::table('CLItems')->select('*')->where("clitemsno", $request->clitemsno)->take(1);
                $clitem = $vtiger->search($clitemQuery);

                while (count($clitem->result) <= 0) {  // TODO Delete while
                    $clitem = $vtiger->search($clitemQuery);
                }

                if (count($clitem->result) > 0) {
                    $clitem =  $vtiger->search($clitemQuery)->result[0];
                    //get contact
                    $obj = $vtiger->retrieve($clitem->id);
                    $obj->result->cf_1212 = $limeConnection['lime_connection']['LS_BASEURL'] . '/' . $surveyValues[0] . "?token=" . $surveyValues[1] . "&lang=" . "en"; //help link
                    $obj->result->cf_acf_rtf_1208 = "This clitem is a questionaire";
                    //$obj->result->cf_1578 = "Pending";
                    $vtiger->update($obj->result);
                    $task = new CloneDBController;

                    $task->updateCLItemFromImmcase($request);
                    $request->request->add(['checklist_id' => $obj->result->cf_1216]);  // Add value to request
                    $task->updateChecklistFromImmcase($request); //checklist of clitem be updated
                }
                // Release the session key
                $myJSONRPCClient->release_session_key($sSessionKey);
                return response()->json(["success" => $surveyValues]);
            }
        } catch (Exception $e) {
            return response()->json("Server error", 500);
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
            $vtiger = new Vtiger();
            $task   = new CloneDBController;
            $now    = Carbon::now()->format('H:i:s');

            $urlObj = parse_url($request->surveyurl);
            $iSurveyID = str_replace('/', '', $urlObj['path']);

            $urlQuery = $urlObj['query'];

            $urlQueryAsArr = [];
            $return = back()->with(['status' => 'error']);

            parse_str($urlQuery,  $urlQueryAsArr);
            $sToken = $urlQueryAsArr['token'];

            $limeConnection = self::connectLime(); //Start limesurvey session
            $myJSONRPCClient = $limeConnection['myJSONRPCClient'];
            $sSessionKey = $limeConnection['sessionKey'];

            $exportSurvey = $myJSONRPCClient->export_responses_by_token(
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

            $exportSurveyAsPDF = $myJSONRPCClient->export_responses_by_token(
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

            /* Find clitem of current survey */
            $clitemQuery = DB::table('CLItems')->select('*')
                ->where("clitemsno", $request->clitemsno)
                ->where("cf_1212", $request->surveyurl)
                ->take(1);

            $clitem = $vtiger->search($clitemQuery);
            while (count($clitem->result) <= 0) {  // TODO Delete while
                $clitem = $vtiger->search($clitemQuery);
            }
            $clitem =  $clitem->result[0];
            $obj = $vtiger->retrieve($clitem->id);
            $request->request->add(['checklist_id' => $obj->result->cf_1216]);
            /*  return
            $obj; */

            $contact = Contact::where('id', $obj->result->cf_contacts_id)->firstOrFail();
            $case =  CPCase::where('id', $obj->result->cf_1217)->firstOrFail();
            $checklist =  Checklist::where('id', $obj->result->cf_1216)->firstOrFail();

            $directory = "/public/documents/contact/$contact->contact_no/cases/$case->ticket_no-$case->ticketcategories/checklists/$checklist->checklistno-$checklist->cf_1706/clitems/" . $obj->result->clitemsno . '-' . $obj->result->cf_1200;
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory); //creates directory if not exists
            }
            /* Download base64encoded responses as file */
            if (is_string($exportSurvey)) {
                $surveyResults = json_decode(base64_decode($exportSurvey));
                $surveyResponses =  $surveyResults->responses;
                $file = $obj->result->name  . '.pdf';
                if ($surveyResponses[0]->submitdate != null) {
                    while (!Storage::exists($directory . '/' . $file)) {
                        if (env('APP_ENV') === 'local') {
                            self::download('', '../storage/app/' . $directory . '/' . $file, $exportSurveyAsPDF); //save survey file on storage folder
                            array_push($urlFiles, (Storage::url($file)));
                        } else {
                            self::download('', './storage/app/' . $directory . '/' . $file, $exportSurveyAsPDF); //save survey file on storage folder
                        }
                    }

                    if (Storage::exists($directory . '/' . $file)) {
                        $obj->result->cf_acf_rtf_1208 = "This clitem is a questionaire was answered full. Try to update at " . $now;
                        $obj->result->cf_1214 = "$contact->cf_1332/$contact->contact_no/$contact->contact_no-cases/$case->ticket_no-$case->ticketcategories/01_SuppliedDocs"; //GD Link
                        $vtiger->update($obj->result);
                        $task->updateCLItemFromImmcase($request);
                    }
                    $return =  back()->with(['status' => 'success']);
                }
            }
            $task->updateChecklistFromImmcase($request);
            // Release the session key
            $myJSONRPCClient->release_session_key($sSessionKey);
            return $return;
        } catch (Exception $e) {
            return response()->json("Server error", 500);
        }
    }


    public function uploadSurveyToDrive(Request $request)
    {
    }

    /**
     * This function is callen when requires starts a limesurvey remotecontrol session
     */
    static function connectLime()
    {
        //TODO Check if release sesion key causes an error
        $limeConnection = [
            'LS_RPCURL' => env('LS_RPCURL'),
            'LS_BASEURL' => env('LS_BASEURL'),
            'LS_USER' => env('LS_USER'),
            'LS_PASSWORD' => ('LS_PASSWORD')
        ];
        $myJSONRPCClient = new JsonRPCClient(env('LS_RPCURL'));
        $sessionKey = $myJSONRPCClient->get_session_key(env('LS_USER'), env('LS_PASSWORD'));

        $groups = $myJSONRPCClient->list_surveys($sessionKey);
        // release the session key
        //$myJSONRPCClient->release_session_key($sessionKey);

        return [
            'myJSONRPCClient' => $myJSONRPCClient,
            'sessionKey' => $sessionKey,
            'lime_connection' => $limeConnection,
            'groups' => $groups,
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
        //header('Content-Disposition: attachment; filename="' . $filename . '"');
        //readfile($filepath);
        // Deletes the temp file
        /*  if (file_exists($filepath)) {
            unlink($filepath);
        } */
    }
}
