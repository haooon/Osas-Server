<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\disease;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class diseaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getDieasesInfoByName(Request $request){
        $input = $request->all();
        try{
            $Disease_name = $input['Disease_name'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $diseases = disease::where('Disease_name','like','%'.$Disease_name.'%')->get();
        // $finished = array('success'=>'true','clock_id'=>$clockid->clock_id);
        return $diseases->toJson();
    }

    public function getDieaseInfoById(Request $request){
        $input = $request->all();
        try{
            $Disease_id = $input['Disease_id'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $disease = disease::where('Disease_id',$Disease_id)->get();
        return $disease->toJson();
    }

    public function getDieasesInfoBySym(Request $request){
        $input = $request->all();
        try{
            $Disease_symptom = $input['Disease_symptom'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $diseases = disease::where('Disease_symptom','like','%'.$Disease_symptom.'%')->get();
        return $diseases->toJson();
    }

}