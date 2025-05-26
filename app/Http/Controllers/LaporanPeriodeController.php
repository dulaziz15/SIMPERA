<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanPeriodeController extends Controller
{
    public function index(){
        $breadcrumb = (object) [
            'title' => 'Daftar Gedung',
            'list' => ['Home', 'Gedung']
        ];

        $page = (object) [
            'title' => 'Daftar Gedung yang terdaftar dalam sistem'
        ];

        $activeMenu = 'gedung';
        return view('laporanPeriode.index', compact('breadcrumb', 'page', 'activeMenu'));
    }
}
