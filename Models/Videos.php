<?php

namespace Modules\Videos\Models;

use ActionModel;
use Purify;

use Modules\Videos\Contracts\VideoContract;
use Illuminate\Database\Eloquent\Builder;
use Modules\Memberships\Traits\Memberships;

use Spatie\Tags\HasTags;
use Modules\Videos\Models\MediaSeen;
use Modules\Media\Traits\InteractsWithMedia;
use Modules\Media\Contracts\HasMedia;
 


class Videos extends ActionModel implements VideoContract,HasMedia {

    
    use Memberships;
    use HasTags;
    use InteractsWithMedia;
    


    public $translatable = [
        'name',
        'description',
        'slug'
    ];
    
    public $sluggable = 'name';

    protected $table = "videos";

    
    protected $appends = [
    
    ];


    protected $casts = [
        'name'  => Purify::class,
        'content' => Purify::class,
    ];

    protected $fillable = [
        'provider',
        'type',
        'name',
        'description',
        'url',
        'autostart',
        'sorting',
        'access',
        'active',
    ];
    

    protected $hidden = [
       // "_lft",
       // "_rgt",
      //  "pivot",
    ];


 
    public function set_content($content){
        
        $this->content = urlencode($content);   
        $this->save();
        return $this;

    }


  

    public function data($seen = null){

        $user_id = optional(auth()->user())->id;

        return $this->hasOne(MediaSeen::class,"media_id")->where("user_id",$user_id);

    }


    public function seen($seen = null){
            
        if(!$seen){ $seen = now(); }

        $this->data()->seen = $seen;

        $this->save();

        return $this;
    
    }

    public function get_content(){

        $this["content"] = urldecode($this->content);
        
    }


    public function convert_to_provider_url($url,$provider){

        if($provider == "youtube"){
         
            $watch_id = $this->get_video_id($url,$provider);
                    
            $this->url = "https://www.youtube.com/watch?v=".$watch_id;

            $this->save();
            
        }
        
        return $this;

    }


    public function get_video_id($url,$provider){

        if($provider == "youtube"){

            foreach(["watch?v=","youtu.be/"] as $s){
                
                if(str_contains($url,$s)){  
                    
                    $url = explode($s,$url);
                
                    if(!isset($url[1])){ return null; }
                    
                    return $url[1];
                    
                    
                }
                
            }

        }

    }



    

    public function save_thumb_from_provider($url,$provider = null){

    
        if($provider == "youtube"){

            $url = $this->get_video_id($url,$provider);

            $this->thumb = "https://i1.ytimg.com/vi/".$url."/mqdefault.jpg";

            $this->save();

        }

      

    }

    
}
