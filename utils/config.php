<?php

function loadconfigfromfile($filename){
	$txtfile = fopen($filename, "r") or die("Unable to open file!");
	$cfgvar = json_decode(fread($txtfile, filesize($filename)));
	fclose($txtfile);

	return $cfgvar;
}

function saveconfigtofile($filename, $data){
	
	$txtfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($txtfile, $data);
	fclose($txtfile);
}
