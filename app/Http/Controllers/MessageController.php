<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class MessageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function smsFunc(){
        
    }
    public function emailFunc(Request $request){
        $input = $request->all();
        $subject = $input['title'];
        $content = $input['content'];
        $to = $input['address'];
        // $_SESSION['title'] = $title;
        $name = "haooon";
        Mail::raw($content,function ($message)use($to, $subject) {
            $message ->to($to)->subject($subject);
        });
    }
    
}