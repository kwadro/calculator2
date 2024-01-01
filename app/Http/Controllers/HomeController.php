<?php

namespace App\Http\Controllers;

use App\Models\Festive;
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
    public function index()
    {
        $user = Auth::user();
        $collection =Festive::all();
        $festiveCollection = $collection->filter(function ($item) use ($user) {
            return $item->user_id === $user->id;
        })->values();
        return view('home',['user'=>$user,'festives'=>$festiveCollection]);
    }
    public function festive(Request $request)
    {
        $this->validate($request,[
            'count_people' => 'required',
        ]);
        $user = Auth::user();
        $festive = new Festive();
        $festive->count_people = $request->count_people;
        $festive->step = $request->step+1;
        $festive->user_id = $user->id;
        $festive->save();
        //Toastr::success('Festive data Successfully Saved','Success');
        return redirect()->route('home');
    }
}
