<?php
/**
 * Created by PhpStorm.
 * User: Shanika-Edirisinghe
 * Date: 20/08/15
 * Time: 11:54
 */

require_once 'core/init.php';

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