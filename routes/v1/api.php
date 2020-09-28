<?php

/*
|--------------------------------------------------------------------------
| V1 Api Routes
|--------------------------------------------------------------------------
*/

$router->group(['namespace' => 'Api\V1'], function() use($router) {
    $router->get('/rooms', 'HotelsController');
});

