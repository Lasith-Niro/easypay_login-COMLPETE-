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
    <!--    <link rel="stylesheet" href=--><?php //echo $temp_var?><!-- >-->
    <!--    <link href="home/css/bootstrap.min.css" rel="stylesheet">-->
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</head>
<body>

<?php
include "header.php";
?>
<div class="container">
    <div class="jumbotron col-lg-6 col-lg-offset-3">
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
                echo  "<script type='text/javascript'>alert('$error');</script>";
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
            <div>
                <div>Your phone number is *******<?php echo substr($old_phone_number,7 , 9); ?></div>
            </div>
            <div>
                <h3>Enter your new phone number</h3>
                <input class="form-control" type="text" name="new_phone_number" id="new_phone_number">
            </div>
            <input class="btn btn-default" id="continue" type="submit" value="Continue">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
    </div>

        <?php
        include "footer.php";
        ?>

</body>
</html>