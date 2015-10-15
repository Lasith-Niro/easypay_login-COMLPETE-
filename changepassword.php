<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:44 PM
 */
require_once 'core/init.php';
require_once 'browser/browserconnect.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password_current' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'password_new'
            )
        ));

        if($validation->passed()){
            if( Hash::make(Input::get('password_current')) !== $user->data()->password ){
                echo 'Your current password is wrong';
            } else {
                $user->update(array(
                   'password' => Hash::make(Input::get('password_new'))
                ));
                Session::flash('home', 'Your password has been changed.');
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
$ua=getBrowser();
$yourbrowser= $ua['name'];
$temp_var;
if ($yourbrowser=="Google Chrome"){
    $temp_var="css/changePasswordCSSChrome.css";
}
elseif($yourbrowser=="Mozilla Firefox"){
    $temp_var="css/changePasswordCSSFirefox.css";
}
elseif($yourbrowser=="Internet Explorer"){
    $temp_var="css/updateCSSInternetExplorer.css";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change | Password</title>
    <link rel="stylesheet" href=<?php echo $temp_var?>>
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
                    <li>
                        <a href="login.php">LOGIN</a>
                    </li>
                    <li>
                        <a href="register.php">REGISTER</a>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <header>

        <img id="ucscLogo" src="images/ucsc.png" height="100px"/>
        <!--<h1 id="welcome">Welcome to Easypay</h1>-->


    </header>
    <div id="updateForm">
    <form action="" method="post">
    <div class="field">
        <label for="Password_current">Current password</label>
        <input type="password" name="password_current" id="password_current">
    </div>
        <hr id="hr">
    <div class="field">
        <label for="Password_new">New password</label>
        <input type="password" name="password_new" id="password_new">
    </div>
        <hr id="hr">
    <div class="field">
        <label for="Password_new_again">New password again</label>
        <input type="password" name="password_new_again" id="password_new_again">
    </div>
        <hr id="hr">
    <input id="change" type="submit" value="Change">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>