<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::all();
      return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // バリデーション＆error文
      $rules = [
          'title' => ['required', 'max:50'],
          'part' => ['required', 'max:50'],
      ];
      $this->validate($request, $rules);

      $id = Auth::id();
      //インスタンス作成
      $post = new Post();

      $post->title = $request->title;
      $post->part = $request->part;
      $post->user_id = $id;

      $post->save();

      return redirect('posts')->with(
        'status',
        $post->title . '登録しました！'
      );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->input('title');

        $post->save();

        return redirect('posts')->with(
          'status',
          $post->title . '更新しました'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect('posts')->with(
          'status',
          $post->title . 'を削除しました！'
        );
    }

    public function search(Request $request)
    {

      $posts = Post::where('title', 'like', "%{$request->search}%")
                ->orWhere('part', 'like', "%{$request->search}%")
                ->paginate(3);

      $search_result = $request->search.'の検索結果'.count($posts).'件';

      return view('post.index',[
        // ''左側がviewの表記、右側の変数が展開される中身
        'posts' => $posts,
        'search_result' => $search_result,
      ]);


    }
}
