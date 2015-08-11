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
            )
        ));
        }
    }
?>