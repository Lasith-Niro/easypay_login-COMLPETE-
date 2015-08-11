<?php
/**
 * Created by PhpStorm.
 * User: lasith-niro
 * Date: 11/08/15
 * Time: 14:39
 */
$url = 'http://localhost:63342/easypay_login-COMLPETE-/profile.php?user=lasith' ;
require_once("dompdf/dompdf_config.inc.php");
spl_autoload_register('DOMPDF_autoload');

function pdf_create($html, $filename, $paper, $orientation, $stream=TRUE) {
    $dompdf = new DOMPDF();
    $dompdf->set_paper($paper, $orientation);
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream($filename.".pdf");
}

//$filename = 'file_name';
//$dompdf = new DOMPDF();
//$html = file_get_contents($url);
//pdf_create($html, $filename, 'A4', 'portrait');


?>






<!---->
<!--if(isset($_POST['submit'])){-->
<!--$content = $url;-->
<!--if(empty($content)){-->
<!--$error = 'Please enter some content to create your pdf';-->
<!--} else {-->
<!--include_once('dompdf/dompdf_config.inc.php');-->
<!---->
<!--$dompdf = new DOMPDF();-->
<!--$dompdf->load_html($content);-->
<!--$dompdf->render();-->
<!--$dompdf->stream('sample.pdf');-->
<!--}-->
<!--}-->
<!--?>-->
<!--<form action="index.php" method="post">-->
<!--    <div class="field">-->
<!--        <textarea name="content" id="content"></textarea>-->
<!--    </div>-->
<!--    <input type="submit" name="submit" value="Download">-->
<!--</form>-->