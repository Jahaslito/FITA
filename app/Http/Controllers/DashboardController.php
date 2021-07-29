<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function resources(){
        $userCount = User::count();
//        dd($userCount);
        return view('admin.dashboard', compact('userCount'));
    }

}
