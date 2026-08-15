<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

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
    public function version(Request $request): ?string
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
        return [
            ...parent::share($request),

            'auth' => [
                'user' => $request->user(),
            ],

            'flash' => [
                'summary' => fn () => $request->session()->get('summary'),
            ],

            /*
            |--------------------------------------------------------------------------
            | Notifications
            |--------------------------------------------------------------------------
            */

            'notifications' => function () use ($request) {
                if (!$request->user()) {
                    return [
                        'unread_count' => 0,
                        'items' => [],
                    ];
                }

                return [
                    'unread_count' => \App\Models\Notification::where(
                        'user_id',
                        $request->user()->id
                    )
                        ->whereNull('read_at')
                        ->count(),

                    'items' => \App\Models\Notification::where(
                        'user_id',
                        $request->user()->id
                    )
                        ->latest()
                        ->limit(10)
                        ->get(),
                ];
            },

            /*
            |--------------------------------------------------------------------------
            | Open Revision Count
            |--------------------------------------------------------------------------
            |
            | Mengirim jumlah permintaan perbaikan yang masih OPEN
            | ke seluruh halaman Inertia.
            |
            | Operator tidak perlu melihat badge ini.
            |
            */

            'openRevisionsCount' => function () use ($request) {
                if (
                    !$request->user() ||
                    $request->user()->role === 'OPERATOR'
                ) {
                    return 0;
                }

                return \App\Models\RevisionRequest::where(
                    'status',
                    'OPEN'
                )->count();
            },
        ];
    }
}
