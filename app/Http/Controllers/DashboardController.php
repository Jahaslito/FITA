<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function resources(){
        $userCount = User::count();
        $temp = Sensor::count();
        $average = Sensor::max('temperature');
//        dd($userCount);
        return view('admin.dashboard', compact('userCount', 'temp', 'average'));
    }

}
