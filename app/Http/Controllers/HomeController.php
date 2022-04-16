<?php

namespace App\Http\Controllers;
use App\Models\Symptom;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $symptom= Symptom::all();
        // return view('home')->with('symptoms',$symptom);
        return view('train_face');
    }
    public function profile()
    {
        return view('profile');
    }
    public function train_face(){
        return view('train_face');
    }
    public function identify_face(){
        return view('identify');
    }
    public function no_access(){
        return view('no_access');
    }
}
