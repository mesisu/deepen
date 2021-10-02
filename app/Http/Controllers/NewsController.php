<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use Auth;

class NewsController extends Controller
{
  public function add()
  {
    
      return view('user.news.create');
  }

  public function create(Request $request)
  {

      // 以下を追記
      // Varidationを行う
      $this->validate($request, News::$rules);

      $news = new News;
      $form = $request->all();
      $news->user_id = auth() ->id();

      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
        $news->image_path = null;
       
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      // データベースに保存する
      $news->fill($form);
      $news->save();

      return redirect('user/news/management');
  }
    // 以下を追記
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      $check_hikoukai = $request->hihyoujijoutai; //１＝非公開と公開を表示
      $q = Auth::user()->news();
      if(isset($cond_title)){
        $q->where('title', 'LIKE', "%{$cond_title}%");
      }
      if(empty($check_hikoukai)){
        $q->where('checkhikoukai', 0);
      }
      return view('user.news.index', ['posts' => $q->paginate(3), 'cond_title' => $cond_title]);
  }   
  
  public function show($news_id)
  {
      $news = News::find($news_id);
      if($news != false) {
       // 表示回数をカウントアップ
          $news['count'] = $news['count'] + 1;
          $news->save();
        return view('user.news.article', ['news' => $news]);
      } else {
        return redirect('user/news/top');
      }
      
  }

//以下を追記 3/14
  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $news = News::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('user.news.edit', ['news_form' => $news]);
      
      
  }


public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, News::$rules);
      // News Modelからデータを取得する
      $news = News::find($request->id);
      // 送信されてきたフォームデータを格納する
     
      
      
      $news_form = $request->all();
       if (isset($news_form['checkhikoukai'])){ //選択されていた場合
         $news->checkhikoukai=1;        
         unset($news_form['checkhikoukai']);
       }else{   //選択されていない場合
         $news->checkhikoukai=0;
       }
      if ($request->remove == 'true') {
          $news_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $news_form['image_path'] = basename($path);
      } else {
          $news_form['image_path'] = $news->image_path;
      }

      unset($news_form['image']);
      unset($news_form['remove']);
      unset($news_form['_token']);
      // 該当するデータを上書きして保存する
      $news->fill($news_form)->save();
      return redirect('user/news/management');
  }
  
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $news = News::find($request->id);
      // 削除する
      $news->delete();
      return redirect('user/news/');
  }  
  
  public function showtop()
  {
      $top_news = News::where('checkhikoukai','0')->orderBy('count','desc')->take(3)->get(); //並び替えした後に取り出し、取得
      
    return view('user.news.top', ['top_news' => $top_news]);
  }
  
  
      public function search(Request $request)
  {
      
          $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = News::where('title', 'LIKE', "%{$cond_title}%")->paginate(4);
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = News::paginate(4);
          
      }
      
      return view('user.news.search', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  

  
}




