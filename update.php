 <?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:44 PM
 */

require_once 'core/init.php';
 require_once 'browser/browserconnect.php';

//checking if the user already logged in
$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
           'name' => array(
               'required' => true,
               'min' => 2,
               'max' => 50
           ),
           'regNumber' => array(
              'required' => true,
              'min' => 9
            ),
           'fname' => array(
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
           'lname' => array(
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
           'email' => array(
                'required' => true,
                'min' => 2,
                'max' => 100
            ),
           'nic' => array(
                'required' => true,
                'min' => 10
            ),
           'dob' => array(
                'required' => true,
            ),
           'year' => array(
                'required' => true,
                'min' => 1
           )
        ));
        if($validation->passed()){
            try{
                $user->update(array(
                    'username' => Input::get('name'),
                    'regNumber' => Input::get('regNumber'),
                    'fname' => Input::get('fname'),
                    'lname' => Input::get('lname'),
//                    'phone' => Input::get('phone'),
                    'email' => Input::get('email'),
                    'nic' => Input::get('nic'),
                    'dob' => Input::get('dob'),
                    'year' => Input::get('year')
                ));
                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');
            } catch(Exception $err) {
                die($err->getMessage());
            }
        } else {
            foreach ($validation->errors() as $er) {
//                echo $er, '<br />';
                ?>
                <script type="text/javascript"> alert(" Sorry, Update failed. <?php echo $er ,'<br />';?>")</script>
 <?php
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
     $temp_var="css/updateCSSChrome.css";
 }
 elseif($yourbrowser=="Mozilla Firefox"){
     $temp_var="css/updateCSSFirefox.css";
 }
 elseif($yourbrowser=="Internet Explorer"){
     $temp_var="css/updateCSSInternetExplorer.css";
 }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <title>User | update</title>
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
         <form action="" method="post" xmlns="http://www.w3.org/1999/html">
             <div class="field">
                 <label for="name">User Name</label>
                 <input type="text" name="name" value="<?php echo escape($user->data()->username); ?>">
             </div>
             <hr id="hr">
             <!--    <div class="field">-->
             <!--        <label for="phone">Phone number</label>-->
             <!--        <input type="string" name="phone" value="--><?php //echo 0 . escape($user->data()->phone); ?><!--">-->
             <!--    </div>-->
             <div class="field">
                 <label for="regNumber">Registration Number</label>
                 <input type="string" name="regNumber" value="<?php echo escape($user->data()->regNumber); ?>">
             </div>
             <hr id="hr">
             <div class="field">
                 <label for="fname">First Name</label>
                 <input type="string" name="fname" value="<?php echo escape($user->data()->fname); ?>">
             </div>
             <hr id="hr">
             <div class="field">
                 <label for="lname">Last Name</label>
                 <input type="string" name="lname" value="<?php echo escape($user->data()->lname); ?>">
             </div>
             <hr id="hr">
             <div class="field">
                 <label for="email">E-mail</label>
                 <input type="string" name="email" value="<?php echo escape($user->data()->email); ?>">
             </div>
             <hr id="hr">
             <div class="field">
                 <label for="nic">NIC</label>
                 <input type="string" name="nic" value="<?php echo escape($user->data()->nic);?>">
             </div>
             <hr id="hr">
             <div class="field">
                 <label for="dob">Date of birth</label>
                 <input type=date name="dob" value="<?php echo escape($user->data()->dob);?>">
             </div>
             <hr id="hr">
             <div class="field">
                 <label for="year">Academic Year</label>
                 <input type="string" name="year" value="<?php echo escape($user->data()->year);?>">
             </div>
             <hr id="hr">
             <input id="submit" type="submit" value="Update">

             <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
         </form>
     </div>