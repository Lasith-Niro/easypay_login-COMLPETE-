<?php
/**
 * Created by PhpStorm.
 * User: Anjana-Nisal
 * Date: 11/08/15
 * Time: 17:29
 */
class notification{
//    var $password="6651";
    function send($from,$to,$message,$password){
        $text = urlencode($message);
        $baseurl ="http://www.textit.biz/sendmsg";
        $url = "$baseurl/?id=$from&pw=$password&to=$to&text=$text";
        $ret = file($url);
        $res= explode(":",$ret[0]);
        if (trim($res[0])=="OK") {
            echo "Message Sent - ID : ".$res[1];
        } else {
            echo "Sent Failed - Error : ".$res[1];
        }
        return $res[1];
    }
}
//$my = new notification();
//$my->message = "this is my testing message";
//$my->send("94772774100","770294331","this is my testing message","2235");
?>