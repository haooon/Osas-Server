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

/**
        * 智能匹配模版接口发短信
        * apikey 为云片分配的apikey
        * text 为短信内容
        * mobile 为接受短信的手机号
        */
        public function send_sms($apikey, $text, $mobile){
            $url="http://yunpian.com/v1/sms/send.json";
            $encoded_text = urlencode("$text");
            $mobile = urlencode("$mobile");
            $post_string="apikey=$apikey&text=$encoded_text&mobile=$mobile";
            return self::sock_post($url, $post_string);
        }
        
        /**
        * url 为服务的url地址
        * query 为请求串
        */
        public function sock_post($url,$query){
                $data = "";
                $info=parse_url($url);
                $fp=fsockopen($info["host"],80,$errno,$errstr,30);
                if(!$fp){
                    return $data;
                }
                $head="POST ".$info['path']." HTTP/1.0\r\n";
                $head.="Host: ".$info['host']."\r\n";
                $head.="Referer: http://".$info['host'].$info['path']."\r\n";
                $head.="Content-type: application/x-www-form-urlencoded\r\n";
                $head.="Content-Length: ".strlen(trim($query))."\r\n";
                $head.="\r\n";
                $head.=trim($query);
                $write=fputs($fp,$head);
                $header = "";
                while ($str = trim(fgets($fp,4096))) {
                    $header.=$str;
                }
                while (!feof($fp)) {
                    $data .= fgets($fp,4096);
                }
                return $data;
            }

    public function smsFunc(Request $request){
        $apikey = "d4fad8e10e030e605e2aca242f6f47c7";
        // //智能匹配模版接口发送样例
        $input = $request->all();
        $mobile = $input['mobile'];
        $text = $input['text'];
        // $mobile = "--------------"; //请用自己的手机号代替
        // $text="【云片网】亲爱的doubiyuzai，您的验证码是------。有效期为100000000小时，请尽快验证";
        self::send_sms($apikey,$text,$mobile);
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