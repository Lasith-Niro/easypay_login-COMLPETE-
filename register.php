<?php
require_once 'core/init.php';
require_once 'browser/browserconnect.php';
//var_dump — Dumps information about a variable
//var_dump(Token::check(Input::get('token')));

if(Session::exists('home')){
    echo '<p>' . Session::flash('home') . '</p>';
}
//checking if the user already logged in
$user = new User();
if($user->isLoggedIn()){
    Redirect::to('userDashboard.php');
}


if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6
                ),
                'password_again' => array(
                    'required' => true,
                    'matches' => 'password'
                ),
                'phoneNo' => array(
                    'required' => true,
                    'min' => 10
                ),
                'nic' => array(
                    'required' => true,
                    'min' => 10
                )
            )
        );
        if($validation->passed()) {
			$_SESSION['username'] = Input::get('username');
            $_SESSION['password'] = Input::get('password');
            $_SESSION['regNo']    = Input::get('regNumber');
            $_SESSION['name1']    = Input::get('name1');
            $_SESSION['name2']    = Input::get('name2');
            $_SESSION['email']    = Input::get('email');
            $_SESSION['phoneNo']    = Input::get('phoneNo');
            $_SESSION['nic']      = Input::get('nic');
            $_SESSION['dob']      = Input::get('dob');
            $_SESSION['year']     = Input::get('year');
            Redirect::to('registerConfirm.php');
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '</ br>';
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
		$temp_var="css/regCSSChrome.css";
	}
	elseif($yourbrowser=="Mozilla Firefox"){
		$temp_var="css/regCSSFirefox.css";
	}
	elseif($yourbrowser=="Internet Explorer"){
		$temp_var="css/regCSSInternetExplorer.css";
	}
	
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register | page</title>
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
                            <a href="index.php">HOME</a>
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

    
    


    <div id="regForm">
        <form action="" method="post">
            <div>
                <input id="username" type="text" name="username"  placeholder="Enter username" value="<?php echo Input::get('username'); ?>" autocomplete="off" >
            </div>

            <div>
                <input id="password" type="password" name="password" placeholder="Enter password">
            </div>

            <div>
                <input id="password_again" type="password" name="password_again" placeholder="Enter your password again">
            </div>

            <div>
                <input id="name1" type="text" name="name1" placeholder="Your first name" value="<?php echo escape(Input::get('name1')); ?>">
            </div>
            <div>
                <input id="name2" type="text" name="name2" placeholder="Your last name" value="<?php echo escape(Input::get('name2')); ?>">
            </div>
            <div>
                <input id="regNumber" type="text" name="regNumber" placeholder="UCSC registration number" value="<?php echo escape(Input::get('regNumber'));?>">
            </div>
            <div>
                <input id="email" type="email" name="email" placeholder="email address" value="<?php echo escape(Input::get('email')); ?>">
            </div>
            <div>
                <input id="phoneNo" type="text" name="phoneNo" placeholder="Mobile number" value="<?php echo escape(Input::get('phoneNo')); ?>">
            </div>
            <div>
                <input id="nic" type="text" name="nic" placeholder="NIC number" value="<?php echo escape(Input::get('nic')); ?>">
            </div>
            <div>
                <input id="dob" type="date" name="dob" placeholder="Date of birth" value="<?php echo escape(Input::get('dob')); ?>">
            </div>
            <div class="field">
                <!--                <input id="year" type="number" name="year" placeholder="Current Academic year" value="--><?php //echo escape(Input::get('year')); ?><!--">-->
                <label for="Syear" >First year</label>
                <input id="year" type="radio" name="year" value="<?php echo escape("1"); ?>">
                <label for="Syear" >Second year</label>
                <input id="year" type="radio" name="year" value="<?php echo escape("2"); ?>">
                <label for="Syear" >Third year</label>
                <input id="year" type="radio" name="year" value="<?php echo escape("3"); ?>">
                <label for="Syear" >Fourth year</label>
                <input id="year" type="radio" name="year" value="<?php echo escape("4"); ?>">
            </div>
			 <div>
            <input type="checkbox" name="accept">
            I agree to the <a href="">Terms and Conditions</a> and <a href="">Privacy Policy</a>
            </div>
            <input type = "hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input id="next" type="submit" value="Next">
        </form>


    </div>
</div>
<!--<script>
function myFunction() {
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("rePassword").value;
    if (pass1 != pass2) {
        //alert("Passwords Do not match");
        document.getElementById("password").style.borderColor = "#E34234";
        document.getElementById("rePassword").style.borderColor = "#E34234";
    }
    else {
        alert("Passwords Match!!!");
    }
}
myFunction();
</script> -->
</body>
</html>
