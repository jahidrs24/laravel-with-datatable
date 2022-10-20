<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
    public function index(Request $request)
    {
        $data = User::all();
        if($request->ajax()){
            return DataTables::of($data)
            ->addColumn('created_at', function($data){
                return  date('m/d/Y h:i:s A', strtotime($data->created_at));
            })
            ->addColumn('updated_at', function($data){
                return  date('m/d/Y h:i:s A', strtotime($data->created_at));
            })
            // ->rawColumn(['created_at'])
            ->make(true);
        }

        return view('home');
    }
}
