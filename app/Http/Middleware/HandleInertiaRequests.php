<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

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
            'icon' => asset('storage/calendar.png'),
            'background' => asset('storage/background.png'),
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'random' => fn() => $request->session()->get('random'),
            ],
            'notifications' => $request->user() ? $request->user()->notifications()->limit(4)->get() : null,
            'hasUnreadNotifications' => $request->user() ? $request->user()->unreadNotifications()->count() > 0 : null,

        ]);
    }
}
