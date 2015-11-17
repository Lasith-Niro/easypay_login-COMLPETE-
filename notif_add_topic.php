<?php
require_once 'core/init.php';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Notification | Page</title>
        <?php include 'headerScript.php'?>
    </head>
<body>
    <div id="wrapper">
        <?php
        include "header.php";
        ?>
    </div>
<div class="backgroundImg container-fluid">


<?php
include "adminSidebar.php";
?>
    <br>
<div class="col-md-9 col-sm-12 col-xs-12">
    <div class="jumbotron col-lg-6 col-lg-offset-1">
    <h3>Add topic</h3>

<?php
$user = new User();
$notification = new Notification();

if(!$user->isLoggedIn()){
    Redirect::to('index.php');
}
//check for admin
if ($user->hasPermission('admin')) {
    if(Input::exists()){
        if(Token::check(Input::get('token'))) {
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
                    Redirect::to('notif_dboard.php');
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

<form action="" method="post" class="form-horizontal">
    <div>
        <strong>Topic</strong>
        <input class="form-control" id="topic" type="text" name="topic" value="<?php echo escape(Input::get('topic')); ?>" >
    </div>
    <div>
        <strong>Detail</strong>
        <textarea class="form-control" name="detail" cols="50" rows="3" id="detail" data-slider-value="<?php echo escape(Input::get('detail')); ?>"></textarea>
    </div>
    <input class="btn btn-default" type="submit" name="Submit" value="Submit" />
    <input class="btn btn-default" type="reset" name="Submit2" value="Reset" />
    <input type = "hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>
    </div>
</div>
</div>
<?php
} else {
    Redirect::to('index.php');
}

include "footer.php";
?>

</body>
</html>