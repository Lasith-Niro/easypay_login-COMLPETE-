<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */
require_once 'core/init.php';
require 'browser/browserconnect.php';

//$_SESSION['uname'] = Input::get('username');

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true
            ),
            'password' => array(
                'required' => true
            ),
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
$ua=getBrowser();
$yourbrowser= $ua['name'];
$temp_var;
if ($yourbrowser=="Google Chrome"){
    $temp_var="css/loginCSSChrome.css";
}
elseif($yourbrowser=="Mozilla Firefox"){
    $temp_var="css/loginCSSFirefox.css";
}
elseif($yourbrowser=="Internet Explorer"){
    $temp_var="css/loginCSSInternetExplorer.css";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <header>

    </header>
    <title>Login | page</title>
    <link rel="stylesheet" href=<?php echo $temp_var?> >
    <link href="home/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="mainWrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
        <div class="container" >
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a href="home page.html">
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
                        <a href="home page.html">HOME</a>
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



    <div id="loginForm">
        <form action="login.php" method="POST">
            <!--<div>
                <h1 id="signin">Sign in</h1>
            </div> -->

            <img id="ucscLogo" src="images/ucsc.png" height="100px"/>
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
            <div id="forgotPassword">  <a href="forgetpass.php" title="To recover your password, click here " >Forgot password?</a></div>
            <hr id="hr">

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
        <a href="register.php"><button id="signupButton">Sign up</button></a>

    </div>

</div>
</body>
</html>