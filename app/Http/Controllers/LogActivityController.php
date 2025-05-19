<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogRequest;
use App\Services\Interfaces\LogActivityServiceInterface;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    protected $logActivityService;
    public function __construct(LogActivityServiceInterface $logActivityService)
    {
        $this->logActivityService = $logActivityService;
    }

    public function index()
    {
        return view('log.index');
    }

    public function storeLog(LogRequest $request)
    {
        $log =  $this->logActivityService->storeLog($request);
        return response()->json([
            'status' => $log ? true : false,
            'message' => $log ? 'Log berhasil disimpan.' : 'Log gagal disimpan.',
        ]);
    }

    public function show($id)
    {
        $log = $this->logActivityService->show($id);
        return view('log.show', compact('log'));
    }
}
