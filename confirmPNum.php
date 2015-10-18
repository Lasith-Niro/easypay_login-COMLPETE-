<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 11/08/15
 * Time: 10:54
 */

require_once 'core/init.php';
require 'SMS/sms.php';
require 'Files/accessFile.php';

$user = new User();
$notification = new smsNotification();
$file = new accessFile();

//echo "Welcome to confirm your phone number!" . '<br />';
//echo $_SESSION['old_number'] . '<br />';
//echo $_SESSION['new_number'] . '<br />';
//echo $randomValue. '<br />';
//echo gettype($rnd);
$hiddenValue = Input::get('storeRandVal');
$randomValue = rand(1000, 9999);
$detailArray = $file->read('Files/RouterPhone');
$messageArray = $file->read_newLine('Files/messages');

//echo $randomValue;

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//variable for $notificationTEXT->send($from,$to,$message,$password)
$from = $detailArray[0];
$phNumber = $_SESSION['new_number'];
$to ='94'.substr($phNumber,1,9);
$pass = $detailArray[1];
//substr($old_phone_number,7 , 9)
$var = $notification->send($from,$to,$messageArray[1] . $randomValue ,$pass);
//echo $var;//for db(development)

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'rand_number' => array(
                'required' => true,
                'min' => 4,
                'max' => 4,
            )
        ));
        if($validation->passed()){
            $input = htmlspecialchars(trim(Input::get('rand_number')));

            if($input == $hiddenValue){
                $user->update(array(
                    'phone' => $_SESSION['new_number']
                ));
                Session::flash('home', 'Your phone number has been changed.');
                Redirect::to('index.php');
            } elseif ($randomValue != $hiddenValue) {
//                echo "error";
                Session::flash('home', 'you enter wrong key code.');
                Redirect::to('index.php');
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br />';
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
    $temp_var="css/confirmPNumCSSChrome.css";
}
elseif($yourbrowser=="Mozilla Firefox"){
    $temp_var="css/confirmPNumCSSFirefox.css";
}
elseif($yourbrowser=="Internet Explorer"){
    $temp_var="css/confirmPNumCSSInternetExplorer.css";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirm | Phone number</title>
    <link rel="stylesheet" href=<?php echo $temp_var?> >
    <link href="home/css/bootstrap.min.css" rel="stylesheet">
    <link href="home/css/full-width-pics.css" rel="stylesheet">
</head>
<body>
<div id="mainWrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a href="homePage.php">
                    <img id="img" src="images/logo.png" alt="" width="150px" >
                </a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav">

                    <li>
                        <a href="homePage.php">HOME</a>
                    </li>
                    <li>
                        <a href="#">UCSC</a>
                    </li>
                    <li>
                        <a href="#">ABOUT</a>
                    </li>

                    <li>
                        <a href="#">SERVICES</a>
                    </li>
                    <li>
                        <a href="#">CONTACT</a>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div id="header">
        <header>
            <img id="ucscLogo" src="images/ucsc.png" />

        </header>
    </div>
    <div id="confirmForm">
        <form action="" method="post">
            <div class="field">
                <label for="rand_number">Enter received code here </label>
                <input type="number" name="rand_number" id="rand_number">
            </div>
            <input type="hidden" name="storeRandVal" value="<?php echo $randomValue; ?>">
            <input id="change" type="submit" value="Change">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
    </div>
</div>
</body>
</html>
