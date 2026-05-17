<?php

namespace Modules\Videos\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Videos\Models\Videos;

class VideosFactory extends Factory
{
    protected $model = Videos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $provider = $this->faker->randomElement(['youtube', 'vimeo']);
        $url = $this->generateVideoUrl($provider);

        return [
            'provider' => $provider,
            'type' => $this->faker->word(),
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'url' => $url,
            'autostart' => $this->faker->boolean(),
            'sorting' => $this->faker->randomDigitNotNull(),
            'access' => $this->faker->randomElement(['public', 'private', 'restricted']),
            'active' => $this->faker->boolean(),
        ];
    }

    /**
     * Generate a video URL based on the provider.
     *
     * @param string $provider
     * @return string
     */
    private function generateVideoUrl($provider)
    {
        switch ($provider) {
            case 'youtube':
                // Here we use a static YouTube URL and add a random query string
                return 'https://www.youtube.com/watch?v=aqz-KE-bpKQ';
            case 'vimeo':
                // Here we use a static Vimeo URL and append a random query string
                return 'https://player.vimeo.com/video/801139876?h=57d0640646';
            default:
                return $this->faker->url();
        }
    }
}
