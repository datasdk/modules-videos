<?php

namespace Modules\Videos\Contracts;

interface VideoContract
{
    public function set_content(string $content);
    
    public function get_content();

    public function data($seen = null);
    

    public function seen($seen = null);

    public function convert_to_provider_url(string $url, string $provider);

    public function get_video_id(string $url, string $provider);

    public function save_thumb_from_provider(string $url, string $provider = null);
}
