<?php
require 'Files/accessFile.php';
$file = new accessFile();
$arr = $file->read('Files/RouterPhone');
echo $arr[1];

?>