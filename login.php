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
if(Session::exists('home')){
    echo '<p>' . Session::flash('home') . '</p>';
}
//checking if the user already logged in
$user = new User();
if($user->isLoggedIn()){
    Redirect::to('dashboard_student.php');
}

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
                //setting session variables...
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['fname'] = escape($user->data()->fname);
                $_SESSION['lname'] = escape($user->data()->lname);
                $_SESSION['userid'] = $user->data()->id;
                if ($user->hasPermission('admin')) {
                    $_SESSION['admin']=true;
                    $_SESSION['student']=false;
                    Redirect::to('dashboard_admin.php');
                }
                else{
                    $_SESSION['student']=true;
                    $_SESSION['admin']=false;
                    Redirect::to('dashboard_student.php');
                }
            } else {
                echo '<script type="text/javascript"> alert(" Sorry, Logging failed. ")</script>';

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
    <header></header>
    <title>Login | page</title>
<!--    <link rel="stylesheet" href=--><?php //echo $temp_var?><!-- >-->
    <link href="css/customCss.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</head>
<body>
<div>
    <?php
    include "header.php";
    ?>
</div>

<div class="container-fluid backgroundImg">
    <br>
    <div id="loginForm" class="jumbotron col-lg-4 col-lg-offset-4 ">
        <img class="col-lg-offset-4" src="images/ucsc.png" height="100px">
        <form action="login.php" method="POST" class="form-horizontal">
            <div>
                <h3 id="signin"><strong>Sign in</strong></h3>
            </div>

<!--            <img align="center" id="ucscLogo" src="images/ucsc.png" height="100px"/>-->
            <div class="gap">
                <label>Username</label><br>
                <input class="form-control" required id="username" type="text" name="username" autocomplete="off" placeholder="Enter username" size="25" maxlength="20"/>
            </div>
            <div class="gap">
                <label>Password</label><br>
                <input class="form-control" required id="password" type="password" name="password" autocomplete="off" placeholder="Enter password" size="25" maxlength="20"/>
            </div>
            <div id="remember" class="gap">
                <input type="checkbox"  name="remember"/> Remember me
            </div>

            <div class="gap">
                <input class="btn btn-primary col-lg-12"  id="loginButton" type="submit" value="Sign in" name="signin"/>
            </div>
            <div id="forgotPassword" class="gap">  <a href="forgetpass.php" title="To recover your password, click here " >Forgot password?</a></div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
        <hr>
        <div class="gap">
            <a href="register.php"><button class="btn btn-default col-lg-12" id="signupButton">Sign up</button></a>
        </div>


    </div>
</div>

<?php
include "footer.php";
?>

</body>
</html>