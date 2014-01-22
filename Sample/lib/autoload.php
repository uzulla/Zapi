<?php
set_include_path(__DIR__);
spl_autoload_register(function($class) {
    $parts = explode('\\', $class);
    $path = implode(DIRECTORY_SEPARATOR, $parts);
    $file = stream_resolve_include_path($path.'.php');
    if($file !== false) {
        require $file;
    }
});