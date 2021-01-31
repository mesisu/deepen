<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //プロフィーﾙ作成
     public function add()
    {
        return view('user.profile.create');
    }

    public function create()
    {
        return redirect('user/profile/create');
    }
    //更新
    public function edit()
    {
        return view('user.profile.edit');
    }

    public function update()
    {
        return redirect('user/profile/edit');
    }
}
