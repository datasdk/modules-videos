<?php

namespace Modules\Videos\Models;

use DataSDK\Categories\Models\Categories as OrigCategories;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Videos\Models\Videos;


class Playlists extends OrigCategories
{


    protected $table = "categories";


    public function videos()
    {
     
        return $this->entries(Videos::class);

    }

}
