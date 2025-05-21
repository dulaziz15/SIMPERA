<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        $page = (object) [
            'title' => 'Dashboard'
        ];

        $activeMenu = 'user';
        return view('index', compact('breadcrumb', 'page', 'activeMenu'));
    }
}
