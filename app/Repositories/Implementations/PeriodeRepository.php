<?php

namespace App\Repositories\Implementations;

use App\Http\Requests\PeriodeRequest;
use App\Models\PeriodeModel;
use App\Repositories\Interfaces\PeriodeRepositoryInterface;

class PeriodeRepository implements PeriodeRepositoryInterface
{
    public function create(array $data)
    {
        return PeriodeModel::create($data) ? true : false;
    }
    public function show($id)
    {
        return PeriodeModel::find($id);
    }

    public function edit($id)
    {
        return PeriodeModel::find($id);
    }

    public function update($id, $data)
    {
        $periode = PeriodeModel::findOrFail($id);
        return $periode->update($data) ? true : false;
    }

    public function delete($id)
    {
        $periode = PeriodeModel::findOrFail($id);
        return $periode->delete() ? true : false;
    }

    public function getPeriodeByCreateLaporan($date)
    {
        return PeriodeModel::whereDate('tanggal_mulai', '<=', $date)
            ->whereDate('tanggal_selesai', '>=', $date)
            ->first();
    }
}
