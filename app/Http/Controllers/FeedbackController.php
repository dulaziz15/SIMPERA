<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Http\Requests\FeedbackRequest;
use App\Services\Interfaces\FeedbackServiceInterface;
use App\Services\Interfaces\LogActivityServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    protected $feedbackService;
    protected $logService;

    public function __construct(FeedbackServiceInterface $feedbackService, LogActivityServiceInterface $logService){
        $this->feedbackService = $feedbackService;
        $this->logService = $logService;
    }

    public function index() {
        return view('feedback.index');
    }

    public function create() {
        return view('feedback.create');
    }

    public function storeFeedback(FeedbackRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $gedung = $this->feedbackService->storeFeedback($request);
            if($gedung) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENAMBAH, 'Menambah feedback lapora perbaikan yang telah selesai', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Disimpan.',
                    'redirect' => url('/tracking')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/tracking')
                ]);
            }
        }

        return redirect('/tracking');
    }

    public function show($id) {
        $feedback = $this->feedbackService->show($id);
        return view('feedback.show', compact('feedback'));
    }

    public function edit($id) {
        $feedback = $this->feedbackService->show($id);
        return view('feedback.edit', compact('feedback'));
    }

    public function confirm($id) {
        $feedback = $this->feedbackService->show($id);
        return view('feedback.confirm', compact('feedback'));
    }
}
