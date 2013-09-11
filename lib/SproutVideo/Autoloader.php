<?php
class SproutVideo_Autoloader
{
    public static function register()
    {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array('SproutVideo_Autoloader', 'autoload'));
    }

    public static function autoload($class)
    {
        echo "{$class}\n";
        if (0 !== strpos($class, 'SproutVideo')) {
            return;
        }
        
        if ($class == 'SproutVideo') {
            $file = dirname(__FILE__) . '/' . str_replace(array('_', "\\"), array('', '/'), $class) . '.php';
        } else {
            $file = dirname(__FILE__) . '/../' . str_replace(array('_', "\\"), array('', '/'), $class) . '.php';
        }

        if (is_file($file)) {
            echo "Requiring: {$class}\n";
            require $file;
        }
    }
}