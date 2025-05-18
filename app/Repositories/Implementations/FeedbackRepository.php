<?php  

namespace App\Repositories\Implementations;

use App\Models\FeedbackModel;
use App\Repositories\Interfaces\FeedbackRepositoryInterface;

class FeedbackRepository implements FeedbackRepositoryInterface {
    public function create(array $data) {
        return FeedbackModel::create($data) ? true : false;
    }

    public function getById($id) {
        return FeedbackModel::find($id) ? true : false;
    }
}