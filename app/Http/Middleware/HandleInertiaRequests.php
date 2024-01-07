<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }
    
    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
    private function getWeather()
    {
        if (!Cache::has('kuressaare_weather')) {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => 'Kuressaare',
                'appid' => config('services.weather.api_key'),
                'units' => 'Metric',
            ])->json();
            Cache::put('kuressaare_weather', $response, now()->addMinutes(10));
        }

        return Cache::get('kuressaare_weather');
    }

}
