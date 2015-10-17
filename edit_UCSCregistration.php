<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 16/10/15
 * Time: 19:59
 */

require_once 'core/init.php';
require_once 'browser/browserconnect.php';
require 'Files/accessFile.php';

$user = new User();
$fObject = new accessFile();
if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
$inFile = $fObject->read('Files/data_UCSCregistration');
$inAmount = $inFile[0];
$inData = $inFile[1];


if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $newDate= Input::get('date');
        $newAmount=Input::get('amount');

        $outData = $newAmount . " " . $newDate;
        $fObject->write('Files/data_UCSCregistration', $outData);
    }
}
?>

<form action="" method="post">
    <div class="field">
        <label for="date">Enter the new date</label>
        <input type="date" name="date" id="date" value="<?php echo($inData)?>">
    </div>

    <div class="field">
        <label for="amount">Enter the new amount</label>
        <input type="text" name="amount" id="amount" value="<?php echo($inAmount)?>" >
    </div>

    <input type="submit" value="Save">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>