<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //user news post
    public function add()
  {
      return view('user.news.create');
  }
}
