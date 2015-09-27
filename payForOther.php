<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 9/19/2015
 * Time: 8:07 PM
 */

require_once 'core/init.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
                'name' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 20
                ),
                'nic' => array(
                    'required' => true,
                    'min' => 10
                ),
                'regNo' => array(
                    'required' => true
                )
            )
        );
        if($validation->passed()) {
//            Redirect::to('registerConfirm.php');
            echo "Getting other person's details ok (validation)";
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '</ br>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pay For Other</title>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<div>
    <div id="mainContent">
        <h1>Pay for another person</h1>
        <h3>Please enter the other person's details</h3>
        <form action="" method="post">

            <input type="checkbox" id="cb1"> He/She is registered with Easypay<br>
            <div id="cb1_feedback"></div>

            <div>
                <input type="text" name="name" placeholder="Name with initials" value="<?php echo Input::get('name'); ?>">
            </div>
            <div>
                <input type="text" name="nic" placeholder="NIC Number" value="<?php echo Input::get('nic'); ?>">
            </div>
            <div>
                <input type="text" name="regNo" placeholder="UCSC Registration Number" value="<?php echo Input::get('regNo'); ?>">
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>

    </div>
</div>
</body>
</html>