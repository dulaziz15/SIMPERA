<?php  

namespace App\Repositories\Interfaces;

interface PenugasanRepositoryInterface {
    public function create($data);
    public function getByTeknisi($id);
    public function updateStatus($id, $data);
}