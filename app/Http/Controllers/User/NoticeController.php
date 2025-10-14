<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    // index
    public function index()
    {
      $rows = Notice::from('notice as n')
        ->orderByDesc('created_at')
        ->paginate(3);
      return view('user.news',compact('rows'));
    }
}
