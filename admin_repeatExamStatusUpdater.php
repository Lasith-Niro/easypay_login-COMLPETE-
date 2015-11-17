<?php
/**
 * Created by PhpStorm.
 * User: lahiru
 * Date: 11/14/2015
 * Time: 9:21 PM
 */
require_once 'core/init.php';

$id = $_GET['id'];
if(isset($_GET['accept'])){
    if($_GET['accept']==true){
        $tdb1 = DB::getInstance()->update('repeat_exam',$id,array('adminStatus' => 1));
        Redirect::to('admin_repeatExamApplication.php');
    }
}
if(isset($_GET['reject'])){
    if($_GET['reject']==true){
        $tdb1 = DB::getInstance()->update('repeat_exam',$id,array('adminStatus' => 2));
        Redirect::to('admin_repeatExamApplication.php');
    }
}