<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 11/08/15
 * Time: 09:13
 */
require_once 'core/init.php';
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
                echo "You entered same phone number";
            } else {
                $_SESSION['old_number'] = $old_phone_number;
                $_SESSION['new_number'] = $new_phone_number;
                Redirect::to('confirmPNum.php');
                }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
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
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change | Phone number</title>
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
    <div id="changeForm">
        <form action="" method="post">
            <div class="field">
                <label for="old_phone_number">Your phone number is *******<?php echo substr($old_phone_number,7 , 9); ?></label>
                <br><br><br>
            </div>
            <div class="field">
                <label for="new_phone_number">Enter your new phone number</label>
                <input type="text" name="new_phone_number" id="new_phone_number">
            </div>
            <input id="continue" type="submit" value="Continue">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
    </div>

</body>
</html>