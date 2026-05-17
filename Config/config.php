<?php

return [

    'name' => "videos",

    'model' => Modules\Videos\Models\Videos::class,

    'admin' => [
    
        'navigationbar' => [

            "group" => "videos",

            "sorting" => 600,

            "link" => [ 
                "name" => "videos", "icon"=> "fas fa-video", "link" => "videos.index" 
            ],

            "submenu" => [ 
                [ "name" => "Overview", "icon"=> "fas fa-video", "link" => "videos.index" ],
                [ "name" => "Add video", "icon"=> "fas fa-video", "link" => "videos.create" ],
                [ "name" => "Categories", "icon"=> "fas fa-video", "link" => "categories.index", "params" => [ "type" => "videos" ] ]
            ]
            
        ],

    ],


     'services' => [
        'youtube' => [
            'domains' => ['youtube.com', 'youtu.be'],
        ],
        'vimeo' => [
            'domains' => ['vimeo.com'],
        ],
        'dailymotion' => [
            'domains' => ['dailymotion.com', 'dai.ly'],
        ],
        'twitch' => [
            'domains' => ['twitch.tv'],
        ],
        'facebook' => [
            'domains' => ['facebook.com', 'fb.watch'],
        ],
        'instagram' => [
            'domains' => ['instagram.com'],
        ],
        'tiktok' => [
            'domains' => ['tiktok.com'],
        ],
        // Flere kan tilføjes efter behov
    ],
];
