<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 11/08/15
 * Time: 19:26
 */

require_once 'core/init.php';
require 'SMS/sms.php';
$notification = new notification();
echo "To confirm your registration enter your registration code..." . '<br />';
$hiddenValue = Input::get('storeRandVal');
$randomValue = rand(1000, 2500);
echo $randomValue;
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
                $user = new User();
                try{
                    $user->create(array(
                        'username'  => $_SESSION['username'],
                        'password'  => $_SESSION['password'],
    //                    'salt' => $salt,
                        'regNumber' => $_SESSION['regNo'],
                        'fname'     => $_SESSION['fname'],
                        'lname'     => $_SESSION['lname'],
                        'email'     => $_SESSION['email'],
                        'phone'     => $_SESSION['phone'],
                        'nic'       => $_SESSION['nic'],
                        'dob'       => $_SESSION['dob'],
    //                  'course'  => Input::get('course'),
                        'year'      => $_SESSION['year'],
                        'group'     => 1
                    ));
                    Session::flash('home', 'You are registered!');
                    Redirect::to('index.php');
                }catch (Exception $e){
                die($e->getMessage());
                }

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
    <input type="submit" value="Register">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>