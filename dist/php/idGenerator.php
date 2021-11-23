<?php

function createId($max){
$digit = '';
	for($i=0; $i<$max;$i++){
		$digit = $digit . rand(0,9);
	}
	return $digit;
	}
        

?>
