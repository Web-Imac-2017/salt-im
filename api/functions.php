<?php

function debug ($variable) 
{
	echo '<pre>' . print_r($variable, true) . '</pre>';
}
function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN"; //a améliorer pck pas unique
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}