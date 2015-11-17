<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 11/08/15
 * Time: 09:13
 */
require_once 'core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update | Page</title>
    <?php include 'headerScript.php'?>
</head>
<body>

<?php
include "header.php";
?>
<div class="backgroundImg container-fluid">
    <br>
    <div class="jumbotron col-lg-5 col-lg-offset-3">
        <?php

$user = new User();
$old_phone_number = $user->data()->phone;

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'new_phone_number' => array(
                'required' => true,
                'min' => 10,
                'max' => 10
            )
        ));

        if($validation->passed()){
            $new_phone_number = Input::get('new_phone_number');
            if($old_phone_number == $new_phone_number){
                $message="You entered same phone number";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $_SESSION['old_number'] = $old_phone_number;
                $_SESSION['new_number'] = $new_phone_number;
                Redirect::to('confirmPNum.php');
                }
        } else {
            foreach ($validation->errors() as $error) {
//                echo  "<script type='text/javascript'>alert('$error');</script>";
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }
    }
}
?>
<?php
require_once 'browser/browserconnect.php';
$ua=getBrowser();
$yourbrowser= $ua['name'];
$temp_var;
if ($yourbrowser=="Google Chrome"){
    $temp_var="css/changeNumberCSSChrome.css";
}
elseif($yourbrowser=="Mozilla Firefox"){
    $temp_var="css/changeNumberCSSFirefox.css";
}
elseif($yourbrowser=="Internet Explorer"){
    $temp_var="css/changeNumberInternetExplorer.css";
}

?>



<!--    <div id="header">-->
<!--        <header>-->
<!--            <img id="ucscLogo" src="images/ucsc.png" />-->
<!---->
<!--        </header>-->
<!--    </div>-->
        <div id="changeForm">
            <form action="" method="post" class="form-horizontal">
                <h3><strong>Change Phone Number</strong></h3>
                <div class="gap">
                    <div class="alert alert-info">Your phone number is *******<?php echo substr($old_phone_number,7 , 9); ?></div>
                </div>
                <div class="gap">
                    <label>Enter your new phone number</label>
                    <input class="form-control" type="text" name="new_phone_number" id="new_phone_number">
                </div>
                <input class="btn btn-default" id="continue" type="submit" value="Continue">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            </form>
        </div>
    </div>
</div>
        <?php
        include "footer.php";
        ?>

</body>
</html>