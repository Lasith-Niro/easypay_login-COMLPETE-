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
//        echo 'ok';
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
           'name' => array(
               'required' => true,
               'min' => 2,
               'max' => 50
           ),
            'phone' => array(
                'required' => true,
                'min' => 10,
            )
        ));



        if($validation->passed()){
            try{
                $user->update(array(
                   'fname' => Input::get('name'),
                    'phone' => Input::get('phone')
                ));

                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');

            } catch(Exception $err) {
                die($err->getMessage());
            }
        } else {
            foreach ($validation->errors() as $er) {
                echo $er, '<br>';
            }

        }

    }
}
?>

 <form action="" method="post" xmlns="http://www.w3.org/1999/html">
    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo escape($user->data()->fname); ?>">
    </div>
    <div class="field">
        <label for="phone">Phone number</label>
        <input type="number" name="phone" value="<?php echo escape($user->data()->phone); ?>">
    </div>

        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>