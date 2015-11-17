<?php
/**
 * Created by PhpStorm.
 * User: Shanika-Edirisinghe
 * Date: 20/08/15
 * Time: 11:54
 */

require_once 'core/init.php';
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
<div class="backgroundImg container-fluid">
    <div class="jumbotron col-lg-6 col-lg-offset-3">
        <br>
<?php

$user = new User();

$id1 = $_SESSION['id'];
//if(!$user->isLoggedIn()){
//    Redirect::to('index.php');
//}
if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
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
            $user->update(array(
                'password' => Hash::make(Input::get('password_new'))
                ),$id1);
            Redirect::to('login.php');
//            Session::flash('home', 'Your password has been changed.');
            }

        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br />';
            }
        }
}
?>

        <form action="" method="post">
            <div class="field">
                <label for="Password_new">New password</label>
                <input class="form-control" type="password" name="password_new" id="password_new">
            </div>
            <div class="field">
                <label for="Password_new_again">New password again</label>
                <input class="form-control" type="password" name="password_new_again" id="password_new_again">
            </div>
            <input class="btn btn-default" type="submit" value="Change">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
    </div>
</div>
<?php
include "footer.php";
?>

</body>
</html>