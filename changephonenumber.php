<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 11/08/15
 * Time: 09:13
 */
require_once 'core/init.php';
$user = new User();
$old_phone_number = $user->data()->phone;

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'new_phone_number' => array(
                'required' => true,
                'min' => 10,
                'max' => 10
            )
        ));

        if($validation->passed()){
            $new_phone_number = Input::get('new_phone_number');
            if($old_phone_number == $new_phone_number){
                echo "You entered same phone number";
            } else {
                $_SESSION['old_number'] = $old_phone_number;
                $_SESSION['new_number'] = $new_phone_number;
                Redirect::to('confirmPNum.php');
                }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="old_phone_number">Your phone number is *******<?php echo substr($old_phone_number,7 , 9); ?></label>
    </div>
    <div class="field">
        <label for="new_phone_number">Enter your new phone number</label>
        <input type="text" name="new_phone_number" id="new_phone_number">
    </div>
    <input type="submit" value="Continue">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>