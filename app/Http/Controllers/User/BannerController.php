<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
      $rows = Banner::from('banner as b')
        ->where('status','y')
        ->orderByDesc('created_at')
        ->get();

      return view('user.index',compact('rows'));
    }
}
