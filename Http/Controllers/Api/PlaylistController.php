<?php

namespace Modules\Videos\Http\Controllers\Api;

use Modules\Videos\Models\Playlists;
use App\Http\Controllers\OrionBaseController;


class PlaylistController extends OrionBaseController
{

    protected $model = Playlists::class;

    protected $alwaysIncludes = [
        "videos"
    ];

    protected $includes = [
        "videos"
    ];

}
