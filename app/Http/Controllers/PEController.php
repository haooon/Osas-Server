<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\PE;
use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class PEController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function addPE(Request $request){
        $input = $request->all();
        try{
            $Huser_height = $input['Huser_height'];
            $Huser_weight = $input['Huser_weight'];
            $Hblood_sugar = $input['Hblood_sugar'];
            $Hblood_fat = $input['Hblood_fat'];
            $Heart_rate = $input['Heart_rate'];
            $Hcholesterol_ester = $input['Hcholesterol_ester'];
            $Htriglyceride = $input['Htriglyceride'];
            $Hdiastolic_pressure = $input['Hdiastolic_pressure'];
            $Hsystolic_pressure = $input['Hsystolic_pressure'];
            $Hear_temperature = $input['Hear_temperature'];
            $Hrecording_time = $input['Hrecording_time'];
            $Htotal_cholesterol = $input['Htotal_cholesterol'];
            $Huser_id = $input['Huser_id'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        
        $start_date = Carbon::today();
        $end_date = Carbon::today()->addHours(24);

        $exist = PE::where('Huser_id', $Huser_id)->where('Hrecording_time',$Hrecording_time)
        ->where('Hrecording_date','>=',$start_date)
        ->where('Hrecording_date','<',$end_date)
        ->first();
        if($exist != null){
            // $finished = array('success'=>'false');
            // return json_encode($finished);
            $request['Hid'] = $exist->Hid;
            // self::fixPE($request);
            $finished = array('success'=>'false','Hid'=>$exist->Hid);
            return json_encode($finished);
        }

        $new = new PE;
        $Hrecording_date = Carbon::now()->toDateString();
        $new->Huser_height = $Huser_height;
        $new->Huser_weight = $Huser_weight;
        $new->Hblood_sugar = $Hblood_sugar;
        $new->Hblood_fat = $Hblood_fat;
        $new->Heart_rate = $Heart_rate;
        $new->Hcholesterol_ester = $Hcholesterol_ester;
        $new->Htriglyceride = $Htriglyceride;
        $new->Hdiastolic_pressure = $Hdiastolic_pressure;
        $new->Hsystolic_pressure = $Hsystolic_pressure;
        $new->Hear_temperature = $Hear_temperature;
        $new->Hrecording_time = $Hrecording_time;
        $new->Htotal_cholesterol = $Htotal_cholesterol;
        $new->Huser_id = $Huser_id;
        $new->Hrecording_date = $Hrecording_date;
        $new->save();

        
        $PEid = PE::where('Huser_id', $Huser_id)->where('Hrecording_time',$Hrecording_time)
        ->where('Hrecording_date','>=',$start_date)
        ->where('Hrecording_date','<',$end_date)->first();
        $finished = array('success'=>'true','Hid'=>$PEid->Hid);
        return json_encode($finished);
    }

    public function fixPE(Request $request){
        $input = $request->all();
        try{
            $Hid = $input['Hid'];
            $Huser_height = $input['Huser_height'];
            $Huser_weight = $input['Huser_weight'];
            $Hblood_sugar = $input['Hblood_sugar'];
            $Hblood_fat = $input['Hblood_fat'];
            $Heart_rate = $input['Heart_rate'];
            $Hcholesterol_ester = $input['Hcholesterol_ester'];
            $Htriglyceride = $input['Htriglyceride'];
            $Hdiastolic_pressure = $input['Hdiastolic_pressure'];
            $Hsystolic_pressure = $input['Hsystolic_pressure'];
            $Hear_temperature = $input['Hear_temperature'];
            $Hrecording_time = $input['Hrecording_time'];
            $Htotal_cholesterol = $input['Htotal_cholesterol'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }

        $start_date = Carbon::today();
        $end_date = Carbon::today()->addHours(24);
        $exist = PE::where('Hrecording_date','>=',$start_date)
        ->where('Hrecording_date','<',$end_date)
        ->where('Hrecording_time',$Hrecording_time)
        ->first();
        if($exist != null && $exist->Hid != $Hid){
            // $finished = array('success'=>'false');
            // return json_encode($finished);
            $request['Hid'] = $exist->Hid;
            // self::fixPE($request);
            $finished = array('success'=>'false','Hid'=>$exist->Hid);
            return json_encode($finished);
        }
        PE::where('Hid', $Hid)->update(
            ['Huser_height'=>$Huser_height,
            'Huser_weight'=>$Huser_weight,
            'Hblood_sugar'=>$Hblood_sugar,
            'Hblood_fat'=>$Hblood_fat,
            'Heart_rate'=>$Heart_rate,
            'Hcholesterol_ester'=>$Hcholesterol_ester,
            'Htriglyceride'=>$Htriglyceride,
            'Hdiastolic_pressure'=>$Hdiastolic_pressure,
            'Hsystolic_pressure'=>$Hsystolic_pressure,
            'Hear_temperature'=>$Hear_temperature,
            'Hrecording_time'=>$Hrecording_time,
            'Htotal_cholesterol'=>$Htotal_cholesterol]
        );
        $finished = array('success'=>'true');
        return json_encode($finished);
    }

    public function getPEs(Request $request){
        $input = $request->all();
        try{
            $Huser_id = $input['Huser_id'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $PEs = PE::where('Huser_id', $Huser_id)->get();
        return $PEs->toJson();
    }

    public function deletePE(Request $request){
        $input = $request->all();
        try{
            $Hid = $input['Hid'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $PE = PE::where('HID', $Hid);
        $PE->delete();
        $finished = array('success'=>'true');
        return $clock->toJson();
    }

    public function getPEsBy(Request $request){
        $input = $request->all();
        try{
            $Huser_id = $input['Huser_id'];
            $n = $input['n'];
            $x = $input['x'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $xxs = PE::where('Huser_id', $Huser_id)->select([$x,'Hrecording_date'])->get();
        $lightTime = Carbon::now()->subDays($n);
        $news = [];
        
        foreach($xxs as $xx){
            if($lightTime<Carbon::createFromFormat('Y-m-d H:i:s',$xx['Hrecording_date'])){
                array_push($news,$xx);
            }
        }
        $finished = $news;
        return json_encode($finished);
    }

    public function getAvgPEsBy(Request $request){
        $input = $request->all();
        try{
            $Huser_id = $input['Huser_id'];
            $n = $input['n'];
            $x = $input['x'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $xxs = PE::where('Huser_id', $Huser_id)->select([$x,'Hrecording_date'])->get();
        $lightTime = Carbon::now()->subDays($n);
        $news = [];
        
        foreach($xxs as $xx){
            if($lightTime<Carbon::createFromFormat('Y-m-d H:i:s',$xx['Hrecording_date'])){
                array_push($news,$xx);
            }
        }

        $final = 0;
        $num = 0;
        foreach($news as $new){
            if($new->$x != Null && $new->$x != 0){
                $final += $new->$x;
                $num += 1;
            }
        }

        $finished = array($x=>$final/$num);
        return json_encode($finished);
    }

    public function getOneDayPEsBy(Request $request){
        $input = $request->all();
        try{
            $Huser_id = $input['Huser_id'];
            $Hrecording_date = $input['Hrecording_date'];
            $Hrecording_date_nextday = Carbon::createFromFormat('Y-m-d H:i:s',$Hrecording_date)->addHours(24);
            $x = $input['x'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        $xxs = PE::where('Huser_id', $Huser_id)
                    ->select([$x,'Hrecording_time'])
                    ->where('Hrecording_date','>=',$Hrecording_date)
                    ->where('Hrecording_date','<',$Hrecording_date_nextday)
                    ->get();
        return $xxs->toJson();
    }

    public function getOneDayAvgPEsBy(Request $request){
        $input = $request->all();
        try{
            $Huser_id = $input['Huser_id'];
            $Hrecording_date = $input['Hrecording_date'];
            $n = $input['n'];
            $x = $input['x'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        
        $total_num = 0;
        $result = array();
        
        for($i = 0; $i<$n ; $i++){
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s',$Hrecording_date)->subDays($i);
            $end_date = Carbon::createFromFormat('Y-m-d H:i:s',$Hrecording_date)->subDays($i)->addHours(24);
            $xxs = PE::where('Huser_id', $Huser_id)
            ->select([$x])
            ->where('Hrecording_date','>=',$start_date)
            ->where('Hrecording_date','<',$end_date)
            ->get();
            $sum = 0;
            $num = 0;
            foreach($xxs as $xx){
                $sum += $xx->$x;
                $num += 1;
            }
            if($num == 0){
                array_push($result,0);
            }else{
                array_push($result,$sum/$num);
            }
            
        }
        return $result;
    }


}