<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 17/10/15
 * Time: 12:21
 */

require_once 'core/init.php';
require 'Files/accessFile.php';
require_once 'browser/browserconnect.php';

$user = new User();
$fileObject = new accessFile();
$notify = new Notification();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

$notifyArray = $fileObject->read_newLine('Files/notificationTEXT');


if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true
                ),
                'msgID' => array(
                    'required' => true
                )
            )
        );
        if($validation->passed()){
            //Redirect::to('payForOtherSuccess.php');

            ////Checking if username exists or not////
            //$userId = $user->data()->id;
            $username = Input::get('username');
            $msgCode = Input::get('msgID');
            if(!$username == null){
                $user2 = new User();
                if($user->find($username)){
                    //get user id
                    $uID = $user2->data()->id;
                    $notify->createNotification(array(
                        'uID' => $uID,
                        'nCode' => $msgCode
                    ));

                }else{
                    //echo 'Not exists<br>';
                    echo'<script type="text/javascript">
                        alert("Username does not exists");
                    </script>';
                    //Redirect::to('payForOther.php');
                }
            }
            //echo 'checking completed<br>';



        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '</ br>';
            }
        }
    }
}
?>


<form action="" method="post">
    <div id="f1">
        <input type="text" name="username" placeholder="Username" <?php echo Input::get('username')?>>
    </div>
    <div id="f2">
        <input type="text" name="msgID" placeholder="message ID" <?php echo Input::get('msgID')?>>
    </div>
    <div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
        <input type="submit" value="Add">
    </div>
</form>