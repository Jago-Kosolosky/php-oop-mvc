<?php
function __autoload($class) {
    $folders = array(
        'controllers/',
        'custom/',
        'lib/',
        'lib/rules/',
        'models/'
    );
    
    $index = 0;
    $folder = $folders[$index];
    while( $folder !== false && ! file_exists($folder . $class . '.php')){
        $index++;
        $folder = isset($folders[$index]) ? $folders[$index] : false;
    }

    if($folder !== false)
        include_once($folder     . $class . '.php');
}