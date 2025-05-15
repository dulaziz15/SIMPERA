<?php

namespace App\Services\Interfaces;

use App\Http\Requests\PeranRequest;
use Illuminate\Support\Facades\Request;

interface PeranServiceInterface {
    public function show($id);
    public function storePeran(PeranRequest $request);
    public function edit($id, PeranRequest $request);
    public function delete($id);
}