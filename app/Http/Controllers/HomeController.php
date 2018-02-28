<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlNhaCungCap;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function myHome()
    {
        return view('myHome');
    }
    public function myUsers()
    {
        return view('myUsers');
    }
      public function qlNhaCungCap()
    {
        $nhacungcap = qlNhaCungCap::all();
        return view('qlNhaCungCap',["nhacungcap"=>$nhacungcap]);
    }
















































































































}
