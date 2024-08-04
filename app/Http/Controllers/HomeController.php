<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected function index()
    {
        return view('home');
    }

    protected function edit(){
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }
    protected function update(Request $request){
        $user=Auth::user();
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'password'=>'required|min:8|confirmed',
        ]);
        $user->name = $request->name;
        $user->phone=$request->phone;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return view('home');
    }
}
