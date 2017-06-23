<?php

spl_autoload_register(function($className){
    $targetFile = __DIR__.'/'.str_replace('\\','/', $className).'.php';
    if(file_exists($targetFile)){
        require $targetFile;
    }
});
