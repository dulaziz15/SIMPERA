<?php

namespace App\Http\Controllers;

use App\Models\NotifikasiModel;
use App\Services\Interfaces\NotifikasiServiceInterface;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    protected $notifikasiService;

    public function __construct(NotifikasiServiceInterface $notifikasiService)
    {
        $this->notifikasiService = $notifikasiService;
    }

    // NotificationController.php
    public function markRead($id)
    {
        $notif = $this->notifikasiService->updateRead($id);
        if( !$notif) {
            return response()->json(['success' => false, 'message' => 'Failed to update notification status'], 500);
        } else {
            return response()->json(['success' => true]);
        }
    }
}
