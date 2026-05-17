<?php

use Illuminate\Http\Request;



Route::group([
    'as' => 'api.videos.',
    'prefix' => 'videos'

], function ($router) {
   
    
    Route::middleware(['auth.both:api'])->group(function () {

        Orion::resource('videos', 'Api\VideosController',['only' => ['index', 'show', 'search']]);

        Orion::resource('playlists', 'Api\PlaylistController',['only' => ['index', 'show', 'search']]);
        

    });


    Route::middleware(['auth:api'])->group(function () {

        Orion::resource('videos', 'Api\VideosController',['except' => ['index', 'show', 'search']]); 
        
        Route::post('videos/{id}/seen', 'Api\VideosController@seen');

    });



        

});