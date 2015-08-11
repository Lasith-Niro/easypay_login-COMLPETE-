<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 11/08/15
 * Time: 10:54
 */

require_once 'core/init.php';
require 'SMS/sms.php';
$user = new User();
$notification = new notification();

echo "Welcome to confirm your phone number!" . '<br />';
//echo $_SESSION['old_number'] . '<br />';
//echo $_SESSION['new_number'] . '<br />';
//echo $randomValue. '<br />';
//echo gettype($rnd);
$hiddenValue = Input::get('storeRandVal');
$randomValue = rand(1000, 1500);
//echo $randomValue;
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
$var = $notification->send("94712364452","770294331","phone number change code is " . $randomValue ,"6651");
echo $var;
if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'rand_number' => array(
                'required' => true,
                'min' => 4,
                'max' => 4,
            )
        ));
        if($validation->passed()){
            $input = htmlspecialchars(trim(Input::get('rand_number')));

            if($input == $hiddenValue){
                $user->update(array(
                    'phone' => $_SESSION['new_number']
                ));
                Session::flash('home', 'Your phone number has been changed.');
                Redirect::to('index.php');
            } elseif ($randomValue != $hiddenValue) {
//                echo "error";
                Session::flash('home', 'you enter wrong key code.');
                Redirect::to('index.php');
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br />';
            }
        }
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="rand_number">Enter number </label>
        <input type="number" name="rand_number" id="rand_number">
    </div>
    <input type="hidden" name="storeRandVal" value="<?php echo $randomValue; ?>">
    <input type="submit" value="Change">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>