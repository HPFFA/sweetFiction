<?php
    $world->getPathTo = function($path) use($world) 
    {
        switch ($path) 
        {
            case 'homepage': 
                return '/';
            case 'registration page': 
                return '/authentication/register';
            case 'login page': 
                return 'authentication/login';
            default: 
                return $path;
        }
    };
?>