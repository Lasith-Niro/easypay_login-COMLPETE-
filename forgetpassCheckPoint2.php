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
    <header></header>
    <title>Login | page</title>
    <!--    <link rel="stylesheet" href=--><?php //echo $temp_var?><!-- >-->
    <!--    <link href="home/css/bootstrap.min.css" rel="stylesheet">-->
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
<?php

$user = new User();

$id = $_SESSION['id'];
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
            $user->update($id, array(
                'password' => Hash::make(Input::get('password_new'))
                ));
            Session::flash('home', 'Your password has been changed.');
            Redirect::to('index.php');
            }

        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br />';
            }
        }
}
?>
<div class="container">
    <div class="jumbotron col-lg-6 col-lg-offset-3">
        <form action="" method="post">
            <div class="field">
                <label for="Password_new">New password</label>
                <input type="password" name="password_new" id="password_new">
            </div>
            <div class="field">
                <label for="Password_new_again">New password again</label>
                <input type="password" name="password_new_again" id="password_new_again">
            </div>
            <input type="submit" value="Change">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        </form>
    </div>
</div>
<?php
include "footer.php";
?>

</body>
</html>