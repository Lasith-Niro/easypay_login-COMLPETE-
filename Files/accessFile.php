 <?php
 /**
  * Created by PhpStorm.
  * User: nadeesh-dilanga
  * Date: 10/08/15
  * Time: 21:46
  */

 class accessFile{
	function read($file){
		$array = explode("\n", file_get_contents($file));
		return $array;
	}
	function write($myfile,$txt){
		$myfile = fopen($myfile, "w");
		fwrite($myfile, $txt);
	    fclose($myfile);
	}
	function writearray($myfile,array $txt){
		$myfile = fopen($myfile, "w");
		for( $number=0 ; $number<=count($txt)-1 ; $number++ ){
			fwrite($myfile,$txt[$number]);
			fwrite($myfile,"\n");
		}
	    fclose($myfile);
	}
} 


 ?>
 
 
 
 
 
 