<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public static function send(
        $userIds,
        string $type,
        string $title,
        string $message,
        $relatedType = null,
        $relatedId = null
    ) {
        $userIds = is_array($userIds) ? $userIds : [$userIds];

        foreach (array_filter($userIds) as $userId) {
            Notification::create([
                'user_id' => $userId,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'related_type' => $relatedType,
                'related_id' => $relatedId,
            ]);
        }
    }

    public static function admins()
    {
        return User::whereIn('role', [
            'ADMIN_CABDIN',
            'SUPER_ADMIN',
        ])->pluck('id')->toArray();
    }

    public static function operatorsOfSchool($schoolId)
    {
        return User::where('role', 'OPERATOR')
            ->where('school_id', $schoolId)
            ->pluck('id')
            ->toArray();
    }
}