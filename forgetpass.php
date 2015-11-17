<?php
/**
 * Created by PhpStorm.
 * User: Shanika-Edirisinghe
 * Date: 12/08/15
 * Time: 11:47
 */

require_once 'core/init.php';
require 'SMS/sms.php';
require 'Files/accessFile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | page</title>
    <?php include 'headerScript.php'?>
</head>
<body>
<div>
    <?php
    include "header.php";
    ?>
</div>
<div id="mainWrapper" class="backgroundImg container-fluid">
    <br>
    <div id="ForgotPassword" class="jumbotron col-lg-6 col-lg-offset-3">
<?php

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true
            )
        ));

    $uname = Input::get('name');
    if($validation->passed()){
        $user1 = new User();
        if($user1->find($uname)){
//            echo "User exist";
            echo "User Found";
        ?>
            <p> <a href="forgetpassCheckPoint.php"> <?php echo escape($user1->data()->username); ?> </a> </p>
        <?php
            $_SESSION['phone'] = $user1->data()->phone;
            $_SESSION['id'] = $user1->data()->id;
            $_SESSION['flag'] = 1;
        } else {
            echo "User Not Found<br>";
        }
    } else {
        foreach ($validation->errors() as $er) {
            echo $er, '<\ br>';
        }
    }

    }
}
?>
<!--<form action="" method="post">-->
<!--    <div class="field">-->
<!--        <label for="name">Enter your username </label>-->
<!--        <input type="text" name="name" id="name">-->
<!--    </div>-->
<!--    <input type="submit" value="Search">-->
<!--    <input type="hidden" name="token" value="--><?php //echo Token::generate(); ?><!--">-->
<!--</form>-->



        <label>Username</label>
        <form action="" method="POST" class="form-horizontal">
            <div class="gap ">
                <input class="form-control " required id="verification" type="text" name="name" autocomplete="off" placeholder="Enter user name" size="25" maxlength="20"/>
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
        <a href=""><button class="btn btn-default" id="nextButton">Next</button></a>

    </div>

</div>
<?php
include "footer.php";
?>

</body>
</html>