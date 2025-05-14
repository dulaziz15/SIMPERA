<?php

namespace App\Services\Interfaces;

use App\Http\Requests\KategoriRequest;

interface KategoriFasilitasServiceInterface {
    public function show($id);
    public function storekategori(KategoriRequest $requeat);
    public function edit($id, KategoriRequest $request);
    public function delete($id);
}