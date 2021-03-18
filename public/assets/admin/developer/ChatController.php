<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\api\v1\BaseController;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use App\Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends BaseController
{
    
    public function getChatAccessToken(Request $request) {
        $validator = Validator::make($request->all(), [
            'identity' => 'required'
        ]);
        if($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }
        try{
            
//            $twilioAccountSid = config('const.chatTwillioSid');
//            $twilioApiKey = config('const.chattwilioApiKey');
//            $twilioApiSecret = config('const.chattwilioApiSecret');
//            
//            // Required for Chat grant
//            $serviceSid = config('const.chattwilioApiSecret');
//            
//            // choose a random username for the connecting user
//            $identity = $request->identity;
//            
//            // Create access token, which we will serialize and send to the client
//            $token = new AccessToken(
//                $twilioAccountSid,
//                $twilioApiKey,
//                $twilioApiSecret,
//                3600,
//                $identity
//            );
//            
//            // Create Chat grant
//            $chatGrant = new ChatGrant();
//            $chatGrant->setServiceSid($serviceSid);
//
//            // Add grant to token
//            $token->addGrant($chatGrant);
            
            
            $twilioAccountSid = 'AC2ab0ba69818800690fadc20e2d34a688';
            $twilioApiKey = 'SK0d62cc479a777b755b6e8437b22f995e';
            $twilioApiSecret = '6VoXlWERKHBy0KInjZ76OsJ3hh3p5ZHQ';


            // Required for Chat grant
            $serviceSid = 'IS62543d039caf4fcf993a578c34ffecb1';
            // choose a random username for the connecting user
            $identity = $request->identity;

            // Create access token, which we will serialize and send to the client
            $token = new AccessToken(
                $twilioAccountSid,
                $twilioApiKey,
                $twilioApiSecret,
                3600,
                $identity
            );

            // Create Chat grant
            $chatGrant = new ChatGrant();
            $chatGrant->setServiceSid($serviceSid);

            // Add grant to token
            $token->addGrant($chatGrant);

            // render token to string
            //echo $token->toJWT();

            // render token to string
            return  Helper::success($token->toJWT());
            
        }catch(\Exception $e){                  
            return  Helper::success([], $e->getMessage());
        }
    }
    
    
    /* Chat Add/Edit  */
    public function AddEditChat(Request $request){        
        $validator = Validator::make($request->all(), [
            'from_user_id' => 'required',
            'to_user_id'=> 'required',
            'channel_name'=> 'required',
        ]);

        if($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }

        try{
            $data = Chat::addEdit($request);
            return Helper::success($data);
            
        }catch(\Exception $e){                  
            return  Helper::success([], $e->getMessage());
        }
    }
    
    
    /* Chat List  */
    public function chatList(Request $request){        
        try{
            //print_r(Auth::user()->id);exit();
            $data = Chat::with('touser')->where('from_user_id',Auth::user()->id)->orderBy('from_user_id','DESC')->get();//touser
            if($data){
                foreach ($data as $data1){
                    $data1->touser->profile_pic = \App\User::getProfile($data1->touser->profile_pic);
                }
            }
            return Helper::success($data);
        }catch(\Exception $e){                  
            return  Helper::success([], $e->getMessage());
        }
    }
    
    /* Chat Add/Edit  */
    public function destroy(Request $request){        
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if($validator->fails()) {
            return Helper::fail([], Helper::error_parse($validator->errors()));
        }
        try{
            Chat::where('id',$request->id)->delete();
            return Helper::success([],trans('messages.chatDelete'));
        }catch(\Exception $e){                  
            return  Helper::success([], $e->getMessage());
        }
    }
  
}
