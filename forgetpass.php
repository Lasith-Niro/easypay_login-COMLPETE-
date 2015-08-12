<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 12/08/15
 * Time: 11:47
 */

require_once 'core/init.php';
require 'SMS/sms.php';
require 'Files/accessFile.php';
if(Input::exists()){
if(Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'name' => array(
            'required' => true
        )
    ));

    if($validation->passed()){
        $user = new User('name');
        if($user->find()){
            echo "User exist";
        } else {
            echo "No User!";
        }

    }

    }
}








?>
<form action="" method="post">
    <div class="field">
        <label for="name">Enter your username </label>
        <input type="text" name="name" id="name">
    </div>
<!--    <input type="hidden" name="storeRandVal" value="--><?php //echo $randomValue; ?><!--">-->
    <input type="submit" value="Search">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>