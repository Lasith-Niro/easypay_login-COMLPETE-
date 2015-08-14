 <?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:44 PM
 */

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
           'name' => array(
               'required' => true,
               'min' => 2,
               'max' => 50
           ),
//            'phone' => array(
//                'required' => true,
//                'min' => 10,
//            ),
            'regNumber' => array(
              'required' => true,
              'min' => 9
            ),
            'fname' => array(
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
            'lname' => array(
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
            'email' => array(
                'required' => true,
                'min' => 2,
                'max' => 100
            ),
            'nic' => array(
                'required' => true,
                'min' => 10
            ),
            'dob' => array(
                'required' => true,
            ),
            'year' => array(
                'required' => true,
                'min' => 1
            )
        ));
        if($validation->passed()){
            try{
                $user->update(array(
                    'username' => Input::get('name'),
                    'regNumber' => Input::get('regNumber'),
                    'fname' => Input::get('fname'),
                    'lname' => Input::get('lname'),
//                    'phone' => Input::get('phone'),
                    'email' => Input::get('email'),
                    'nic' => Input::get('nic'),
                    'dob' => Input::get('dob'),
                    'year' => Input::get('year')
                ));
                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');
            } catch(Exception $err) {
                die($err->getMessage());
            }
        } else {
            foreach ($validation->errors() as $er) {
                echo $er, '<br />';
            }
        }
    }
}
?>

 <form action="" method="post" xmlns="http://www.w3.org/1999/html">
    <div class="field">
        <label for="name">User Name</label>
        <input type="text" name="name" value="<?php echo escape($user->data()->username); ?>">
    </div>
<!--    <div class="field">-->
<!--        <label for="phone">Phone number</label>-->
<!--        <input type="string" name="phone" value="--><?php //echo 0 . escape($user->data()->phone); ?><!--">-->
<!--    </div>-->
    <div class="field">
        <label for="regNumber">Registration Number</label>
        <input type="string" name="regNumber" value="<?php echo escape($user->data()->regNumber); ?>">
    </div>
    <div class="field">
        <label for="fname">First Name</label>
        <input type="string" name="fname" value="<?php echo escape($user->data()->fname); ?>">
    </div>
    <div class="field">
        <label for="lname">Last Name</label>
        <input type="string" name="lname" value="<?php echo escape($user->data()->lname); ?>">
    </div>
    <div class="field">
        <label for="email">E-mail</label>
        <input type="string" name="email" value="<?php echo escape($user->data()->email); ?>">
    </div>
    <div class="field">
        <label for="nic">NIC</label>
        <input type="string" name="nic" value="<?php echo escape($user->data()->nic);?>">
    </div>
     <div class="field">
         <label for="dob">Date of birth</label>
         <input type=date name="dob" value="<?php echo escape($user->data()->dob);?>">
     </div>
     <div class="field">
         <label for="year">Academic Year</label>
         <input type="string" name="year" value="<?php echo escape($user->data()->year);?>">
     </div>

    <input type="submit" value="Update">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>