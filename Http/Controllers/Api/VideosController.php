<?php

namespace Modules\Videos\Http\Controllers\Api;


use App\Http\Controllers\OrionBaseController;
use Orion\Http\Requests\Request;

use Modules\Videos\Models\Videos;

use Modules\Memberships\Models\Plan;
use Modules\Memberships\Models\Feature;

use Modules\Videos\Http\Resources\BaseResource;

use Modules\Videos\Policies\VideosPolicy;
use Modules\Videos\Models\MediaSeen;

use Modules\Videos\Http\Requests\VideoRequest;


class VideosController extends OrionBaseController
{

   
    protected $model = Videos::class;

    protected $request = VideoRequest::class;
   
    protected $parentPolicy  = VideosPolicy::class;

    protected $sortableBy = [
        'id', 
        'name', 
        'sorting', 
    ];
   
    protected $includes = [
        'categories', 
        'category', 
        'available', 
        'images',
        'data'
    ];


    protected $searchableBy = [
        'type',
        'provider',
        'name',
        'url',
        'categories.name'
    ];




    public function seen(Request $req,$id){
        
    
        $seen       = $req->boolean("seen") ? now() : null;
        $user_id    = $req->user()->id;



        return MediaSeen::updateOrCreate([
            "media_id" => $id,
            "user_id" => $user_id,
        ],[
            "seen" => $seen
        ]);

    }


}
