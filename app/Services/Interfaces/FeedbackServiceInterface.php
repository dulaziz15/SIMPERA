<?php 

namespace App\Services\Interfaces;

use App\Http\Requests\FeedbackRequest;

interface FeedbackServiceInterface {
    public function storeFeedback(FeedbackRequest $request);
    public function show($id);
}