<?php  

namespace App\Repositories\Implementations;

use App\Models\PenugasanModel;
use App\Repositories\Interfaces\PenugasanRepositoryInterface;

class PenugasanRepository implements PenugasanRepositoryInterface {
    public function create($data){
        return PenugasanModel::create($data) ? true : false;
    }
}