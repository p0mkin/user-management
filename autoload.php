<?php
spl_autoload_register(function ($class) {
    // Remove "App\" prefix because your folders are in the root directory
    $classPath = str_replace('App\\', '', $class);
    
    $file = __DIR__ . '/' . str_replace('\\', '/', $classPath) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});
?>