<?php

namespace Modules\Videos\Models;

use Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaSeen extends Model {

 //   use SoftDeletes;

    protected $table = "media_seen";

    protected $fillable = [
        "media_id",
        "user_id",
        "seen",
        "seen_amount",
        "seen_prc"
    ];
    
}
