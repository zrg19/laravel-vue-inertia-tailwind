<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $user = auth()->user();
        return array_merge(parent::share($request), [
            'auth' => [
                'isLoggedIn' => auth()->check(),
                'user'       => auth()->check() ? [
                    'name'         => $user->name,
                    'email'        => $user->email,
                    'subscription' => [
                        'isSubscribed' => true,
                        'ends_at'      => Carbon::now()->addYear(1),
                    ],
                    'can' => [
                        'createMonitor' => true,
                    ],
                ] : [],
            ],
        ]);
    }
}
