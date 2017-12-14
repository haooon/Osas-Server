<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\clock;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class clockController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function setClock(Request $request){
        $input = $request->all();
        try{
            $dName = $input['dName'];
            $dDose = $input['dDose'];
            $Reminder_time = $input['Reminder_time'];
            $User_id = $input['User_id'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        
        $exist = clock::where('User_id', $User_id)->where('dName',$dName)->where('Reminder_time',$Reminder_time)->first();
        if($exist != null){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }

        $new = new clock;
        $new->dName = $dName;
        $new->dDose = $dDose;
        $new->Reminder_time = $Reminder_time;
        $new->User_id = $User_id;
        $new->save();
        $clockid = clock::where('User_id', $User_id)->where('dName',$dName)->where('Reminder_time',$Reminder_time)->first();
        $finished = array('success'=>'true','clock_id'=>$clockid->clock_id);
        return json_encode($finished);
    }

    public function resetClock(Request $request){
        $input = $request->all();
        try{
            $clock_id = $input['clock_id'];
            $dName = $input['dName'];
            $dDose = $input['dDose'];
            $Reminder_time = $input['Reminder_time'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $clock = clock::where('clock_id', $clock_id);
        $clock->update(
            [
                'dName'=>$dName,
                'dDose'=>$dDose,
                'Reminder_time'=>$Reminder_time
                ]);
        $finished = array('success'=>'true');
        return json_encode($finished);
    }

    public function deleteClock(Request $request){
        $input = $request->all();
        try{
            $clock_id = $input['clock_id'];
            
            $clock = clock::where('clock_id', $clock_id);
            $clock->delete();
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $finished = array('success'=>'true');
        return json_encode($finished);
    }

    function unicode_decode($name){
         $json = '{"str":"'.$name.'"}';
         $arr = json_decode($json,true);
         if(empty($arr)) return '';
         return $arr['str'];
       }

    public function getClocks(Request $request){
        $input = $request->all();
        $User_id = $input['User_id'];
        $clock = clock::where('User_id',$User_id)->get();
        
        // return mb_detect_encoding($clock[0]->dName);
        return $clock;
    }
}