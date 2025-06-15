<?php

use App\Models\NotifikasiModel;
use App\Models\LaporanPerbaikanModel;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getUserNotifications')) {
    /**
     * Get user notifications
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    function getUserNotifications(int $userId, int $limit = 10)
    {
        return NotifikasiModel::with('pengguna')
            ->where('id_pengguna', Auth::user()->id_pengguna)
            ->latest()
            ->limit($limit)
            ->get();
    }
}

if (!function_exists('notificationIcon')) {
    /**
     * Get icon for notification type
     */
    function notificationIcon(?string $type): string
    {
        return match($type) {
            'laporan' => 'bx bx-file',
            'system'  => 'bx bx-cog',
            'comment' => 'bx bx-comment',
            'support' => 'bx bx-like',
            default   => 'bx bx-bell',
        };
    }
}

if (!function_exists('notificationIconColor')) {
    /**
     * Get color for notification type
     */
    function notificationIconColor(?string $type): string
    {
        return match($type) {
            'laporan' => 'primary',
            'system'  => 'info',
            'comment' => 'warning',
            'support' => 'success',
            default   => 'secondary',
        };
    }
}

// if (!function_exists('markNotificationAsReadUrl')) {
//     /**
//      * Generate URL to mark notification as read
//      */
//     function markNotificationAsReadUrl(int $notificationId): string
//     {
//         return route('notifications.read', ['notification' => $notificationId]);
//     }
// }