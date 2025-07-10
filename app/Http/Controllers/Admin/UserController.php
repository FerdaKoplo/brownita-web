<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function accountAdminIndex() {
        $users = User::where('role', '=', 'admin')->get();
        return view('admin.AccountResource.Pages.viewAccount', compact('users'));
    }

    public function accountAdminCreate(){

    }

    public function accountAdminStore(){

    }

    public function accountAdminEdit(){

    }

    public function accountAdminUpdate(){

    }

    public function accountAdminDelete(){

    }

}
