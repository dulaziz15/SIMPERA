<?php

namespace App\Repositories\Implementations;

use App\Http\Requests\PeriodeRequest;
use App\Models\PeriodeModel;
use App\Repositories\Interfaces\PeriodeRepositoryInterface;

class PeriodeRepository implements PeriodeRepositoryInterface {
    public function index(){}
    public function create(array $data){
        return PeriodeModel::create($data) ? true : false;
    }
    public function show($id){}
    public function storePeriode(PeriodeRequest $request){}
}