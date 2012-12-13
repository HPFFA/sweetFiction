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
            case 'user list page':
                return 'users';
            case 'user profile 1':
                return 'users/view/1';
            case 'user profile 2':
                return 'users/view/2';
            case 'user profile 1 edit page':
                return 'users/edit/1';
            case 'user profile 2 edit page':
                return 'users/edit/2';
            default: 
                return $path;
        }
    };
?>