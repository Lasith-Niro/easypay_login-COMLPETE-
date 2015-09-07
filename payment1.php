
<?php
require_once 'core/init.php';
require_once 'browser/browserconnect.php';
//var_dump — Dumps information about a variable
//var_dump(Token::check(Input::get('token')));

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
                )
            )
        );

        if ($validation->passed()) {
            $user = new User();
//            $salt = Hash::salt(32); //improve the security  of the password
//            echo $salt;
//            die();
            try{
                $user->create(array(
                    'username'  => Input::get('username'),
                    'password'  => Hash::make(Input::get('password')),
//                    'salt' => $salt,
                    'fname'     => Input::get('name1'),
                    'lname'     => Input::get('name2'),
                    'email'     => Input::get('email'),
                    'phone'     => Input::get('phoneNo'),
                    'nic'       => Input::get('nic'),
                    'dob'       => Input::get('dob'),
//                  'regNo'     => Input::get('regNo'),
//                  'course'  => Input::get('course'),
                    'year'      => Input::get('year'),
                    'group'     => 1
                ));
//                echo $user->data()->salt;
                Session::flash('home', 'You have been registered and now log in!');
                Redirect::to('index .php');
            }catch (Exception $e){
                die($e->getMessage());
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
	$ua=getBrowser();
	$yourbrowser= $ua['name'];
	$temp_var;
	if ($yourbrowser=="Google Chrome"){
		$temp_var="css/payment1CSSChrome.css";
	}
	elseif($yourbrowser=="Mozilla Firefox"){
		$temp_var="css/payment1CSSMozilaFirefox.css";
	}
	elseif($yourbrowser=="Internet Explorer"){
		$temp_var="css/payment1CSSInternetExplorer.css";
	}
	
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment | page</title>
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
    			<img id="img" src="images/logo.png" alt="" width="150px" >
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
                            <a href="#">HOME</a>
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

    <div id="header">
        <header>
			<img id="ucscLogo" src="images/ucsc.png" /> 

        </header>

    </div>
     

    <div id="paymentForm">

        <form action="" method="post">
            <div id="a">
				<select id="dropdown">
					  <option value="type1">UCSC Registration Fee</option>
					  <option value="type2">Registration Fee For New Academic Year</option>
					  <option value="type3">Repeat Exam Fee</option>
				</select>

            </div>

            <div id="notifiation">
				<ul style="color:black;" class="asd">
                <!-- <input id="amount" type="text" name="amount" placeholder="Enter Amount">  -->
				<!--<li><label style="color:white;"><p align="left"></p></label></li>
				<li><label style="color:white;"><p align="left"></p></label></li>
				<li><label style="color:white;"><p align="left"><br></br></p></label></li>	
				<p></p>-->
				<br/>
				<li><b>UCSC Registration Fee = Rs:3500</b></li>
				<li><b>Registration Fee For New Academic Year = Rs:800</b></li>
				<li><b>Repeat Exam Fee = Rs:30</b></li>
				</ul><br/>
            </div>
			
		
			<div id="bt">
			<input type = "hidden" name="token" value="<?php echo Token::generate(); ?>">
            
			<input id="back" type="submit" value="Back" style="width:85px;height:25px;">
			<input id="next" type="submit" value="Pay" style="width:85px;height:25px;">
			</div>

            
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
