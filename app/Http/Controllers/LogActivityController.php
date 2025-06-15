<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogRequest;
use App\Services\Interfaces\LogActivityServiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogActivityController extends Controller
{
    protected $logActivityService;
    public function __construct(LogActivityServiceInterface $logActivityService)
    {
        $this->logActivityService = $logActivityService;
    }

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Log Activity',
            'list' => ['Log Activity', 'Log']
        ];

        $page = (object) [
            'title' => 'Daftar Log Activity sistem'
        ];

        $activeMenu = 'log';
        return view('log.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function data() {
        $logData = $this->logActivityService->getAll();
        return DataTables::of($logData)->make(true);
    }

    public function show($id)
    {
        $log = $this->logActivityService->show($id);
        return view('log.show', compact('log'));
    }
}
