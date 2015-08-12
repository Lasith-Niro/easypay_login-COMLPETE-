<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 11/08/15
 * Time: 22:47
 */

//http://phptopdf.com/

require ('phpToPDF.php');
$pdf_arr = array(
    "source_type" => 'url',
    "source" => 'http://ucsc.cmb.ac.lk/',
    "action" => 'save'
);
phptopdf($pdf_arr);

//Your HTML in a variable
$my_html="profile.php";

//Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
//$pdf_options = array(
//    "source_type" => 'html',
//    "source" => $my_html,
//    "action" => 'save',
//    "save_directory" => 'my_pdfs',
//    "file_name" => 'my_filename.pdf');
//phptopdf($pdf_options);
?>