<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\article;
use App\MH;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class articleController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getArticlesBy(Request $request){
        $input = $request->all();
        try{
            $User_id = $input['User_id'];
        }catch(Exception $e){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }
        
        $exist = MH::where('User_id', $User_id)->first();
        if($exist == null){
            $finished = array('success'=>'false');
            return json_encode($finished);
        }

        $disease = explode('|',$exist->disease_id);
        // return $disease;
        $article = [];
        for($i = 0;$i<count($disease);$i++){
            
            $articles = article::where('Disease_id', $disease[$i])->get()->toArray();
            // if($articles != null){
            $article = array_merge($article,$articles);
            // }
        }
        return $article;
    }


    public function getArticles(Request $request){
        $articles = article::where('Disease_id', 0)->get();
        return $articles;
    }
}