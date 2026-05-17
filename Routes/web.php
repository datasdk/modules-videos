<?php

use Illuminate\Http\Request;



Route::group([
"middleware" => ["web","auth","role:admin|editor|analyzer|guest"],
], function ($router) {
   
    
    Route::resource('videos', 'VideosController');

    //Orion::resource('playlists', 'PlaylistController');
             

});