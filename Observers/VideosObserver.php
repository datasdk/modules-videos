<?php

namespace Modules\Videos\Observers;

use Modules\Videos\Models\Videos;

class VideosObserver
{
    public function saving(Videos $video)
    {
        if (!$video->url) return;

        $url = trim($video->url);

        foreach (config('videos.services') as $provider => $config) {
            foreach ($config['domains'] as $domain) {
                if (str_contains($url, $domain)) {
                    $video->provider = $provider;
                    $video->url = $this->normalizeUrl($url, $provider);
                    return;
                }
            }
        }
    }

    protected function normalizeUrl(string $url, string $provider): string
    {
        return match($provider) {
            'youtube' => $this->normalizeYouTubeUrl($url),
            'vimeo' => $this->normalizeVimeoUrl($url),
            'dailymotion' => $this->normalizeDailymotionUrl($url),
            'twitch' => $this->normalizeTwitchUrl($url),
            'facebook' => $this->normalizeFacebookUrl($url),
            'instagram' => $this->normalizeInstagramUrl($url),
            'tiktok' => $this->normalizeTikTokUrl($url),
            default => $url,
        };
    }

    protected function normalizeYouTubeUrl(string $url): string
    {
        $parts = parse_url($url);
        parse_str($parts['query'] ?? '', $query);

        $videoId = $query['v'] ?? null;
        if (!$videoId && isset($parts['path'])) {
            $segments = explode('/', trim($parts['path'], '/'));
            $videoId = end($segments);
        }

        return "https://www.youtube.com/embed/{$videoId}";
    }

    protected function normalizeVimeoUrl(string $url): string
    {
        $parts = parse_url($url);
        $segments = explode('/', trim($parts['path'], '/'));
        $videoId = end($segments);
        return "https://player.vimeo.com/video/{$videoId}";
    }

    protected function normalizeDailymotionUrl(string $url): string
    {
        $parts = parse_url($url);
        $segments = explode('/', trim($parts['path'], '/'));
        $videoId = end($segments);
        return "https://www.dailymotion.com/embed/video/{$videoId}";
    }

    protected function normalizeTwitchUrl(string $url): string
    {
        $parts = parse_url($url);
        $segments = explode('/', trim($parts['path'], '/'));
        $videoId = end($segments);
        return "https://player.twitch.tv/?video={$videoId}&parent=" . request()->getHost();
    }

    protected function normalizeFacebookUrl(string $url): string
    {
        return str_replace('www.facebook.com', 'www.facebook.com/plugins/video.php?href=https://www.facebook.com', $url);
    }

    protected function normalizeInstagramUrl(string $url): string
    {
        return $url; // Instagram embed kræver script i frontend
    }

    protected function normalizeTikTokUrl(string $url): string
    {
        return $url; // TikTok embed kræver script i frontend
    }
}
