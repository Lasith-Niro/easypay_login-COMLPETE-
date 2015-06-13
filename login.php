<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */

require_once 'core/init.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
           'username' => array('required' => true),
            'password' => array('required' => true),
        ));

        if($validation->passed()){
            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;
//            $pass = Input::get('password');
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if($login){

                Redirect::to('index.php');
            } else {
                ?>
                <script type="text/javascript"> alert(" Sorry, Logging failed. ")</script>
<?php
//                echo '<p> Sorry, Logging failed. </p>';
//                echo Hash::make($pass, $user->data()->salt);
            }
        } else {
            foreach ($validation->errors() as $er) {
                echo $er, '<\ br>';
            }

        }
    }
}
?>
<!--
<form action="" method="post">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
    </div>

    <div class="field">
        <label for="password"> Password </label>
        <input type="password" name="password" id="password" autocomplete="off">
    </div>

    <div class="field">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember"> Remember Me
        </label>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Log in">
</form>
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | page</title>
    <link rel="stylesheet" href="css/loginCSS.css">
</head>
<body>
<div id="mainWrapper">
    <!--<div id="header">
        <header>
            <img id="ucscLogo" src="ucsc.png" height="100px"/>
            <h1 id="welcome">Welcome to Easypay</h1>
            <img id="easypayLogo" src="logo.png" height="100px"/>
        </header>
    </div> -->
    <div id="loginForm">
        <form action="login.php" method="POST">
            <!--<div>
                <h1 id="signin">Sign in</h1>
            </div> -->
            <img id="ucscLogo" src="images/ucsc.png" />
            <img id="easypayLogo" src="images/logo.png" height="100px"/>
            <div>
                <input required id="username" type="text" name="username" autocomplete="off" placeholder="Enter username" size="25" maxlength="20"/>
            </div>
            <div>
                <input required id="password" type="password" name="password" autocomplete="off" placeholder="Enter password" size="25" maxlength="20"/>
            </div>
            <div id="remember"><input type="checkbox"  name="remember"/> Remember me</div>

            <div>
                <input id="loginButton" type="submit" value="Sign in" name="signin"/>
            </div>
            <div id="forgotPassword">  <a href="http://www.google.com" title="To recover your password, click here " >Forgot password?</a></div>
            <hr id="hr">

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
        <a href="register.php"><button id="signupButton">Sign up</button></a>

    </div>

</div>
</body>
</html>
