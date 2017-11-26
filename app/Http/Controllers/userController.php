<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\useruser;
use App\MH;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class userController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function register(Request $request){
        $input = $request->all();
        // return $input;
        try{
            $User_name = $input['User_name'];
            $User_password = $input['User_password'];
            $User_email = $input['User_email'];
            $User_phone = $input['User_phone'];
            $User_sex = $input['User_sex'];
            $User_age = $input['User_age'];
            $Disease_id = $input['Disease_id']; 
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        
        $existPhone = useruser::where('User_phone', $User_phone)->first();
        $existEmail = useruser::where('User_email', $User_email)->first();
        if($existPhone != null && $existEmail != null){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }

        $new = new useruser;
        $new->User_name = $User_name;
        $new->User_password = $User_password;
        $new->User_email = $User_email;
        $new->User_phone = $User_phone;
        $new->User_sex = $User_sex;
        $new->User_age = $User_age;
        $new->save();

        $User_id = useruser::where('User_phone', $User_phone)->where('User_email', $User_email)->first();

        $new = new MH;
        $new->user_id = $User_id->User_id;
        $new->disease_id = $Disease_id;
        $new->save();

        $finished = array('success'=>'true','User_id'=>$User_id->User_id);
        return json_encode($finished);
    }

    public function login(Request $request){
        $input = $request->all();
        try{
            $User_email = $input['User_email'];
            $User_password = $input['User_password'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $check = $existEmail = useruser::where('User_email', $User_email)->first();
        if($check->User_email == $User_email){
            $finished = array('success'=>'true','User_id'=>$check->User_id);
            return json_encode($finished);
        }else{
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
    }
}