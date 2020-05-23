<?php

namespace App\Http\Controllers;

use App\UssdMenu;
use App\UssdSession;
use Illuminate\Http\Request;

class UssdController extends Controller
{
    public function app(Request $request)
    {
        error_reporting(0);
        header('Content-type: text/plain');
        set_time_limit(100000);

        

        //get inputs
        $input = UssdHelperController::getInputs($request);

        $mifos_ussd_session = UssdSession::wherePhone($input->phone)->first();
        //get the session
        if(!$mifos_ussd_session){
            $mifos_ussd_session = new UssdSession();
            $mifos_ussd_session->phone = $input->phone;
            $mifos_ussd_session->save();
        }else{
            $mifos_ussd_session->save();
        }
        //check if the user/phone is starting
        if (UssdHelperController::user_is_starting($input->latest_text)) {

            $mifos_ussd_session = UssdHelperController::resetUser($mifos_ussd_session);
            $root_menu = UssdMenu::whereIsRoot(1)->first();
            $response = UssdHelperController::nextMenuSwitch($mifos_ussd_session,$root_menu);
            UssdHelperController::sendResponse($response, 1, $mifos_ussd_session,$app,$input);
        } else {
            $message = $input->latest_text;

            switch ($mifos_ussd_session->session) {

                case 0 :
                    //neutral user
                    break;
                case 1 :
                    //user authentication
                    break;
                case 2 :
                    $response = UssdHelperController::continueUssdProgress($mifos_ussd_session, $message);
                    //echo "Main Menu";
                    break;
                case 3 :
                    //confirm USSD Process
                    $response = self::confirmUssdProcess($mifos_ussd_session, $message);
                    break;
                case 4 :
                    //Go back menu
                    $response = UssdHelperController::confirmGoBack($mifos_ussd_session, $message);
                    break;
                case 5 :
                    //Go back menu
                    $response = self::resetPIN($mifos_ussd_session, $message);
                    break;
                case 6 :

                    //accept terms and conditions
                    $menu = UssdMenu::find($mifos_ussd_session->menu_id);
                    $response = UssdHelperController::customApp($mifos_ussd_session, $menu,$message);
                    break;
                default:
                    break;
            }
            UssdHelperController::sendResponse($response, 1, $mifos_ussd_session,$app,$input);
        }


    }


}
