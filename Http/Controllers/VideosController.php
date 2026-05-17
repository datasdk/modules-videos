<?php

namespace Modules\Videos\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Videos\Models\Videos;
use Modules\Videos\Http\Requests\VideoRequest;

class VideosController extends Controller
{
    protected $includes = [
        'categories',
        'category',
        'available',
        'images',
        'data',
    ];

    /**
     * Display a listing of videos.
     */
    public function index()
    {
        $videos = Videos::paginate(15);
        return view('videos::index', compact('videos'));
    }

    /**
     * Show form to create a video.
     */
    public function create()
    {
        return view('videos::create');
    }

    /**
     * Store a new video.
     */
    public function store(VideoRequest $req)
    {

        $video = Videos::create($req->validated() + ["type" => "video"]);


        if ($req->has("available")) {

            $video->set_available([
                "from" => $req->available['from'],
                "to" => $req->available['to']
            ]);

        }


        if ($req->has("categories")) {

            $video->setCategories($req->categories);

        }


        if ($req->has("tags")) {

            $video->syncTags($req->tags);

        }


        return redirect()->route('videos.index')
                         ->with('success', 'Video oprettet successfully.');

    }

    /**
     * Show a specific video.
     */
    public function show(Videos $video)
    {


        return view('videos::show', compact('video'));

    }

    /**
     * Show form to edit a video.
     */
    public function edit(Videos $video)
    {

        return view('videos::edit', compact('video'));

    }

    /**
     * Update a video.
     */
    public function update(VideoRequest $req, Videos $video)
    {

        if ($req->has("categories")) {

            $video->setCategories($req->categories);

        }


        if ($req->has("tags")) {

            $video->syncTags($req->tags);

        }


        $video->update($req->validated() + ["type" => "video"]);


        return redirect()->route('videos.index')
                         ->with('success', 'Video opdateret successfully.');

    }

    /**
     * Delete a video.
     */
    public function destroy(Videos $video)
    {

        $video->delete();

        return redirect()->route('videos.index')
                         ->with('success', 'Video slettet successfully.');

    }
    
}
