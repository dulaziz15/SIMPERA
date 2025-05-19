<?php

namespace App\Services\Interfaces;

use App\Http\Requests\LogRequest;

interface LogActivityServiceInterface {
    public function storeLog(LogRequest $request);
    public function show($id);
}