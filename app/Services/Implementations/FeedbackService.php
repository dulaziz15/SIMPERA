<?php

namespace App\Services\Implementations;

use App\Http\Requests\FeedbackRequest;
use App\Repositories\Interfaces\FeedbackRepositoryInterface;
use App\Services\Interfaces\FeedbackServiceInterface;
use Illuminate\Support\Facades\Auth;

class FeedbackService implements FeedbackServiceInterface
{
    protected $feedbackRepository;

    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function storeFeedback(FeedbackRequest $request)
    {
        return $this->feedbackRepository->create([
            'id_pengguna' => $request->id_pengguna, // ganti Auth::user()
            'id_laporan' => $request->id_laporan, // ganti id_laporan real
            'penilaian' => $request->penilain,
            'komentar' => $request->komentat
        ]);
    }

    public function show($id)
    {
        return $this->feedbackRepository->getById($id);
    }
}
