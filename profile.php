<?php
/**
 * Created by PhpStorm.
 * User: Lasith Niroshan
 * Date: 5/23/2015
 * Time: 1:43 PM
 */


require_once 'core/init.php';

echo $_SERVER['REQUEST_URI'];
if(!$username = Input::get('user')){
    Redirect::to('index.php');
}else{
    $user = new User($username);
    if(!$user->exists()){
        Redirect::to(404);
    }else{
        $data = $user->data();
    }
    ?>

    <h3><?php echo escape($data->username); ?> </h3>
    <p>First name: <?php echo escape($data->fname); ?> </p>
    <p>Phone number: <?php echo escape($data->phone); ?> </p>
    <?php
}

?>