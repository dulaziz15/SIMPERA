<?php  

namespace App\Repositories\Interfaces;

interface FeedbackRepositoryInterface {
    public function create(array $data);
    public function getById($id);
}