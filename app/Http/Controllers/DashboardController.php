<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Dashboard', 'Dashboard']
        ];

        $page = (object) [
            'title' => 'Dashboard'
        ];

        $activeMenu = 'dashboard';
        return view('welcome', compact('breadcrumb', 'page', 'activeMenu'));
    }
}
