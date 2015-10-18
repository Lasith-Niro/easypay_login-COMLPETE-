<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 18/10/15
 * Time: 14:25
 */
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {






} else {
    Redirect::to('index.php');
}

?>
<form action="" method="post">

    <label for="text1">Send to<br></label>
        <UL type="DISC">
            <li>Year wise:</li>
                <UL type="NONE">
                    <li><input type="checkbox" name="firstYear" value="<? echo escape('1')?>" /> First Years <br></li>
                    <li><input type="checkbox" name="secondYear" value="<? echo escape('2')?>" /> Second Years <br></li>
                    <li><input type="checkbox" name="thirdYear" value="<? echo escape('3')?>" /> Third Years <br></li>
                    <li><input type="checkbox" name="fourthYear" value="<? echo escape('4')?>" /> Fourth Years <br></li>
                </UL>
            <hr>

            <li>Selected students: </li>

        </UL>
</form>