<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function homeIndex(){
        return view('admin.AdminDashboard');
    }

}
