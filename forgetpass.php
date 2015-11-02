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
    <header></header>
    <title>Login | page</title>
    <!--    <link rel="stylesheet" href=--><?php //echo $temp_var?><!-- >-->
    <!--    <link href="home/css/bootstrap.min.css" rel="stylesheet">-->
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
<div id="mainWrapper" class="container backgroundImg">
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
        $user = new User();
        if($user->find($uname)){
//            echo "User exist";
        ?>
            <p> <a href="forgetpassCheckPoint.php"> <?php echo escape($user->data()->username); ?> </a> </p>
        <?php
            $_SESSION['phone'] = $user->data()->phone;
            $_SESSION['id'] = $user->data()->id;
        } else {
            echo "User Not Found";
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