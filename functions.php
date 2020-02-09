<?php

function maxValue($arrayDifference){
//var_dump($arrayPrice);
$a = 0;
foreach($arrayDifference as $item)
{
    
    if ($item > $a)
    {
        $a =  $item;
    }
}
return $a;
}