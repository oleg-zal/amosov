<?php
function autoloader($class)
{
   
        //var_dump($class); exit;
        $classParts = explode('\\', $class); 
        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php'; 
        //var_dump($path); exit;
        if(file_exists($path)) {
            require $path;
        }
}
spl_autoload_register('autoloader');