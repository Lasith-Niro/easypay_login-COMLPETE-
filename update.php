 <?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:44 PM
 */

require_once 'core/init.php';
 require_once 'browser/browserconnect.php';
 ?>
 <!DOCTYPE html>
 <html lang="en" xmlns="http://www.w3.org/1999/html">
 <head>
     <title>Update | Page</title>
     <!--    <link rel="stylesheet" href=--><?php //echo $temp_var?><!-- >-->
     <!--    <link href="home/css/bootstrap.min.css" rel="stylesheet">-->
     <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
     <script type="text/javascript" src="js/functions.js"></script>
     <link href="css/customCss.css" rel="stylesheet">
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
 <div class="container backgroundImg">
     <br>
     <div class="jumbotron col-lg-5 col-lg-offset-3">
         <?php

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

<!--     <header>-->
<!---->
<!--         <img id="ucscLogo" src="images/ucsc.png" height="100px"/>-->
<!--         <!--<h1 id="welcome">Welcome to Easypay</h1>-->
<!--         -->
<!--     </header>-->
         <div id="updateForm">
             <form action="" method="post" xmlns="http://www.w3.org/1999/html">
                 <h3><strong>Update</strong></h3>
                 <div class="gap">
                     <label>Username</label>
                     <input class="form-control" type="text" name="name" disabled value="<?php echo escape($user->data()->username); ?>">
                 </div>
                 <!--    <div class="field">-->
                 <!--        <label for="phone">Phone number</label>-->
                 <!--        <input type="string" name="phone" value="--><?php //echo 0 . escape($user->data()->phone); ?><!--">-->
                 <!--    </div>-->
                 <div class="gap">
                     <label>Registration Number</label>
                     <input class="form-control" type="string" name="regNumber" value="<?php echo escape($user->data()->regNumber); ?>">
                 </div>
                 <div class="gap">
                     <label>First Name</label>
                     <input class="form-control" type="string" name="fname" value="<?php echo escape($user->data()->fname); ?>">
                 </div>

                 <div class="gap">
                     <label>Last Name</label>
                     <input class="form-control" type="string" name="lname" value="<?php echo escape($user->data()->lname); ?>">
                 </div>

                 <div class="gap">
                     <label>E-mail</label>
                     <input class="form-control" type="email" name="email" value="<?php echo escape($user->data()->email); ?>">
                 </div>

                 <div class="gap">
                     <label>NIC</label>
                     <input class="form-control" type="string" name="nic" value="<?php echo escape($user->data()->nic);?>">
                 </div>

                 <div class="gap">
                     <label>Date of birth</label>
                     <input class="form-control" type=date name="dob" value="<?php echo escape($user->data()->dob);?>">
                 </div>

                 <div class="gap">
                     <label>Academic Year</label>
                     <input class="form-control" type="string" name="year" value="<?php echo escape($user->data()->year);?>">
                 </div>

                 <input class="btn btn-default" id="submit" type="submit" value="Update">

                 <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
             </form>
         </div>
     </div>
 </div>
         <?php
         include "footer.php";
         ?>

 </body>
 </html>