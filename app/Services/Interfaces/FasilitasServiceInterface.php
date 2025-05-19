<?php  

namespace App\Services\Interfaces;

use App\Http\Requests\FasilitasRequest;

interface FasilitasServiceInterface {
    public function getAll();
    public function storeFasilitas(FasilitasRequest $request);
    public function show($id);
    public function update($id, FasilitasRequest $request);
    public function delete($id);
}