<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Auth;
class ProfileController extends Controller
{
    //プロフィーﾙ作成
     public function add()
    {
        return view('user.profile.create');
    }

    public function create(Request $request)
    {
              // 以下を追記
      // Varidationを行う
      $this->validate($request, Profile::$rules);
      

      $profile = new Profile;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['profile_image'])) {
        $path = $request->file('profile_image')->store('public/image');
        $profile->profile_image = basename($path);
      } else {
          $profile->profile_image = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['profile_image']);
      
      // データベースに保存する
      $profile->fill($form);
      $profile->user_id=Auth::id();
      $profile->save();

       return redirect('user/news/top');
    }
    //更新
    public function edit(Request $request)
    {
        // News Modelからデータを取得する
      $profile = Auth::user()->profile;
      if (empty($profile)) {
        abort(404);    
      }
      return view('user.profile.edit', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
              // Validationをかける
      $this->validate($request, Profile::$rules);
      // News Modelからデータを取得
      $profile = Auth::user()->profile;
      
      
      $profile_form = $request->all();
      if ($request->remove == 'true') {
          $profile_form['profile_image'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $profile_form['profile_image'] = basename($path);
      } else {
          $profile_form['profile_image'] = $profile->profile_image;
      }

      unset($profile_form['image']);
      unset($profile_form['remove']);
      unset($profile_form['_token']);
      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
        return view('user.profile.edit', [ 'profile' => $profile ]);
    }
    
      public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
     
  }  
    
    
    
    
    public function index()
    {
        return view('user.profile.create');
    }
    
    
    public function show($profile_id)
    {
      
      $user = User::findOrFail($profile_id);
      if (empty($user)) {
        abort(404);    
      }
      
    return view('user.profile.user', ['profile' => $user->profile ]);
  }
}
