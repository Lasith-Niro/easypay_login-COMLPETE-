<?php
/**
 * Created by PhpStorm.
 * User: Shanika-Edirisinghe
 * Date: 12/08/15
 * Time: 14:10
 */
require_once 'core/init.php';
require 'SMS/sms.php';
require 'Files/accessFile.php';

$user = new User();
$notification = new notification();
$file = new accessFile();

$pNum = $_SESSION['phone'];
$id = $_SESSION['id'];
$hiddenValue = Input::get('storeRandVal');
$randomValue = rand(1000, 9999);
$detailArray = $file->read('Files/RouterPhone');
$messageArray = $file->read('Files/messages');

echo $randomValue;

//if(!$user->isLoggedIn()){
//    Redirect::to('index.php');
//}
$var = $notification->send($detailArray[0],$pNum ,$messageArray[2] . $randomValue ,$detailArray[1]);
echo $var;      //for db(development)

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
                Session::flash('home', 'Your phone number has been changed.');
                Redirect::to('forgetpassCheckPoint2.php');
            } elseif ($randomValue != $hiddenValue) {
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
        <label for="phone_number">Your phone number is *******<?php echo substr($pNum,7 , 9); ?></label>
    </div>

    <div class="field">
        <label for="code">Enter your verification </label>
        <input type="number" name="rand_number" id="rand_number">

    </div>

    <input type="hidden" name="storeRandVal" value="<?php echo $randomValue; ?>">
    <input type="submit" value="Change">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

</form>