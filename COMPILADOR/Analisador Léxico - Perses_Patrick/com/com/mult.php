<?php

$width= 5;
$height = 5;

        for ($j=0; $j < $height; $j++){ 
            for ($k = 0; $k < $width; $k++){
            	$rato[$j][$k] = $k;
            	$rato2[$j][$k] = $k;

        }    	
            } 
$maxWidtha = max( array_map( 'count',  $rato ) );
$maxWidthb = max( array_map( 'count',  $rato2 ) );
$contatudo = (count($rato, COUNT_RECURSIVE)-$height);

echo "$maxWidthb $maxWidtha $contatudo";

 for ($i = 0; $i < count($rato, COUNT_RECURSIVE)-$height; $i++) {
            for ($j = 0; $j < count($rato2, COUNT_RECURSIVE)-$height; $j++) {
                for ($x = 0; $x < $rato[$i][$j]; $x++) {
                    $c[$i][$j] = $rato[$i][$x] * $rato2[$x][$j];
                    echo($c[$i][$j]);
                    echo(" ");
                }
            }
}
?>