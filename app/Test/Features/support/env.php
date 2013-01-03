<?php
    $world->getPathTo = function($path) use($world) 
    {
        switch ($path) 
        {
            case 'homepage': 
                return '/';
            case 'registration': 
                return '/authentication/register';
            case 'login': 
                return 'authentication/login';
            case 'user list':
                return 'users';
            case 'user profile 1':
                return 'users/view/1';
            case 'user profile 2':
                return 'users/view/2';
            case 'user profile 1 edit':
                return 'users/edit/1';
            case 'user profile 2 edit':
                return 'users/edit/2';
            case 'story list':
                return 'stories';
            case 'story detail 1':
                return 'stories/view/1';
            case 'chapter detail 1':
                return 'story_chapters/view/1';
            default: 
                return $path;
        }
    };
?>