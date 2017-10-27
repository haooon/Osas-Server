<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class MessageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function smsFunc(){
        
    }
    public function emailFunc(Request $request){
        $input = $request->all();
        $to = $input['address'];
        $title = $input['title'];
        $content = $input['content'];
        sendEmail($to,$title,$request);
        return $input;
    }
    function sendEmail($to,$title,$content){
        require_once "Smtp.class.php";
        $smtpserver = "smtp.yeah.com";//SMTP服务器
        $smtpserverport = 25;//SMTP服务器端口
        $smtpusermail = "haooon@yeah.com";//SMTP服务器的用户邮箱
        $smtpemailto = $_POST[$to];//发送给谁
        $smtpuser = "haooon@yeah.com";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
        $smtppass = "1141135276Shr";//SMTP服务器的用户密码
        $mailtitle = $_POST[$title];//邮件主题
        $mailcontent = "<h3>".$_POST[$content]."</h3>";//邮件内容
        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
        $smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
    }
}