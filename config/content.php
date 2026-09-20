<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Supported CV content locales
    |--------------------------------------------------------------------------
    |
    | Independent from the UI/system locale (app.locale). Add more codes here
    | when expanding beyond Arabic and English.
    |
    */

    'locales' => ['en', 'ar'],

    'default' => env('CONTENT_LOCALE', 'en'),

];
