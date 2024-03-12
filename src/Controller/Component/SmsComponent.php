<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class SmsComponent extends Component
{

    public $enablesms = 0;

    public function send($mobile_number, $message)
    {
        $username = "FarmerX";
        $password = "Farmerx@123";
        $sender = "FARMX";
        // $mobile_number = 8688728339;

       // $url = "https://www.bulksmsgateway.in/sendmessage.php?user=" . urlencode($username) . "&password=" . urlencode($password) . "&mobile=" . urlencode($mobile_number) . "&message=" . urlencode($message) . "&sender=" . urlencode($sender) . "&type=" . urlencode('3') . "&template_id=" . urlencode($templateid);
        $url = "https://login.bulksmsgateway.in/sendmessage.php?user=" . urlencode($username) . "&password=" . urlencode($password) . "&mobile=" . urlencode($mobile_number) . "&message=" . urlencode($message) . "&sender=" . urlencode($sender) . "&type=" . urlencode('3') ;
        if ($this->enablesms == 1) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $error = curl_error($ch);
            $info = curl_getinfo($ch);
            
              debug($url);
              debug($info);
              debug($error);
              debug($result);
		
             
            curl_close($ch);
            die;
        }
    }
    public function forgotpasswordsmsotp( $mobile, $otp)
    {
        echo $mobile.'--'.$otp;
        /*$message = "Dear $name, Seems, You have forgotten the Login Password on this Member ID: $memberid Don't worry, Please enter this OTP $otp UMESPACE�";
        $templateid = "1707164953711179833";*/
       /* $message = "Dear $name, This is your OTP $otp for your Member ID: $memberid UMESPACE�";
        $templateid = "1707165009200574965";*/
        $message = "Dear Sir/Madam, Seems, You have forgotten the Login Password . Don't worry, Please enter this OTP $otp FARMERX";
        // $templateid = "1707167670637280338";
        $this->send($mobile, $message);
        return null;
    }
}