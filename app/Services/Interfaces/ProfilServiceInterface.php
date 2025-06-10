<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ProfilRequest;

interface ProfilServiceInterface
{
    public function getProfil($id);
    public function updateImage($id, $request);
    public function update(ProfilRequest $request, $id);
}