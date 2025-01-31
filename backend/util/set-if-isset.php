<?php

function set_if_isset($var){
    if(isset($var)){
        return $var;
    }
    return null;
    
}


echo (set_if_isset($x));
?>