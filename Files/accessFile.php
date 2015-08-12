 <?php


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

 /*
 $x = new file;
 print_r ($x->read('file2.txt'));
 
 $y = new file;
 $y -> write('qwe.txt','asdasdasdasdasda');
 
 $fw = new file;
 $fw->writearray('newdoc.txt',array('a','aaa','aasdad','amdsh','ayuydthsdf',));
*/
?>
 
 
 
 
 
 