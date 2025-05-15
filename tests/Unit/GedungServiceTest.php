<?php

namespace Tests\Unit;

use App\Http\Requests\GedungRequest;
use App\Repositories\Interfaces\GedungRepositoryInterface;
use App\Services\Implementations\GedungService;
use PHPUnit\Framework\TestCase;
use Mockery;

class GedungServiceTest extends TestCase
{
    protected $gedungRepositoryMock;
    protected $gedungService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->gedungRepositoryMock = Mockery::mock(GedungRepositoryInterface::class);
        $this->gedungService = new GedungService($this->gedungRepositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_store_gedung_success()
    {
        // Mock repository
        $repositoryMock = \Mockery::mock(GedungRepositoryInterface::class);
        $repositoryMock->shouldReceive('create')
            ->once()
            ->with([
                'kode' => 'KD01',
                'nama' => 'Gedung A',
                'deskripsi' => 'Deskripsi gedung',
            ])
            ->andReturn(true);

        // Buat instance service dengan repository mock
        $service = new GedungService($repositoryMock);

        // Mock GedungRequest
        $requestMock = \Mockery::mock(GedungRequest::class);

        // Set properti yang dibutuhkan service
        $requestMock->kode = 'KD01';
        $requestMock->nama = 'Gedung A';
        $requestMock->deskripsi = 'Deskripsi gedung';

        // Panggil method storeGedung dengan mock request
        $result = $service->storeGedung($requestMock);

        $this->assertTrue($result);
    }


    public function testShowReturnsGedung()
    {
        $gedungData = (object) ['id' => 1, 'kode' => 'G01', 'nama' => 'Gedung A'];
        $this->gedungRepositoryMock
            ->shouldReceive('getById')
            ->once()
            ->with(1)
            ->andReturn($gedungData);

        $result = $this->gedungService->show(1);
        $this->assertEquals($gedungData, $result);
    }
}
