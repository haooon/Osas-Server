<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\test;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class testController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function cha(){
        $flights = test::all();
        foreach ($flights as $flight) {
            echo $flight->name;
        }
        return $flights->toJson();
    }
    public function zeng(){
        $flight = new test;
        $flight->name_test = '111';
        $flight->id_test = 4;
        $flight->save();
        $flights = test::all();
        foreach ($flights as $flight) {
            echo $flight->name;
        }
        return $flights->toJson();
    }

    public function gai(){
        $flights = test::where('id_test', 1);
        $flights->update(['name_test'=>'ssshhhrrr']);
        return self::cha();
    }

    public function shan(){
        $flights = test::where('id_test', 1);
        $flights->delete();
        return self::cha();
    }
}