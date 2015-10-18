<?php
require_once 'core/init.php';

// get data that sent from form

/*
$topic=$_POST['topic'];
$detail=$_POST['detail'];
$name0=$_POST['name'];
$email=$_POST['email'];

$datetime=date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO $tbl_name(topic, detail, name, email, datetime)VALUES('$topic', '$detail', '$name', '$email', '$datetime')";
$result=mysql_query($sql);

if($result){
    echo "Successful<BR>";
    echo "<a href=notif_main_forum.php>View your topic</a>";
}
else {
    echo "ERROR";
}
mysql_close();
*/
$user = new User();
$notification = new Notification();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
               'topic' => array(
                   'required' => true,
                   'max' => 255
               ),
               'detail' => array(
                   'required' => true
               )
            )
        );
        if($validation->passed()){
            $topic = Input::get('topic');
            $detail = Input::get('detail');
            $datetime=date("d/m/y h:i:s"); //create date time
            $notification->createNotification(array(
                'topic' => $topic,
                'detail' => $detail,
                'datetime' => $datetime
                ));

            if($notification){
//                echo "Successful";
                echo "<a href=notif_main_forum.php>View all notification</a>";
            }
            else {
                echo "ERROR";
            }
//            echo $topic . '</ br>';
//            echo $detail . '</ br>';
        } else {
            foreach($validation->errors() as $error){
                echo $error , '</ br>';
            }
        }
    }

}
?>

<form action="" method="post">
    <div>
        <strong>Topic</strong>
        <input id="topic" type="text" name="topic" value="<?php echo escape(Input::get('topic')); ?>" >
    </div>
    <div>
        <strong>Detail</strong>
        <textarea name="detail" cols="50" rows="3" id="detail" data-slider-value="<?php echo escape(Input::get('detail')); ?>"></textarea>
    </div>
    <input type="submit" name="Submit" value="Submit" />
    <input type="reset" name="Submit2" value="Reset" />
    <input type = "hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>