<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 12/08/15
 * Time: 14:10
 */
require_once 'core/init.php';
$pNum = $_SESSION['phone'];







?>


<form action="" method="post">
    <div class="field">
        <label for="old_phone_number">Your phone number is *******<?php echo substr($pNum,7 , 9); ?></label>
    </div>
    <div class="field">
        <label for="code">Enter your verification </label>
        <input type="text" name="code" id="code">
    </div>
    <input type="submit" value="Continue">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>