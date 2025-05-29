<?php  

namespace App\Services\Implementations;

use App\Repositories\Interfaces\PendukungRepositoryInterface;
use App\Services\Interfaces\PendukungServiceInterface;
use Illuminate\Support\Facades\Auth;

class PendukungService implements PendukungServiceInterface {
    protected $pendukungRepository;

    public function __construct(PendukungRepositoryInterface $pendukungRepository) {
        $this->pendukungRepository = $pendukungRepository;
    }

    public function createWithLaporan(array $request) {
        return $this->pendukungRepository->createWithLaporan($request);
    }

    public function updateWithLaporan($data) {
        return $this->pendukungRepository->updateWithLaporan($data);
    }   
}