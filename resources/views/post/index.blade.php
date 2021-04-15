@extends("layouts.app")
@section("content")
<div class="card-body">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card-title">
          <form action="{{ route('posts.search') }}" method="POST">
            {{ csrf_field() }}
            <div class="input-group">
              <div class="form-outline">
                <input type="search" id="form1" class="form-control" name="search">
                <label class="form-label" for="form1">Search</label>
              </div>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          一覧画面
        </div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <a href="{{ url('posts/create') }}" class="btn btn-success mb-3">登録</a>
          <table class="table">
            <thead>
              <tr>
                <th>id</th>
                <th>title</th>
                <th>part</th>
                <th>user_id</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($posts as $post)
              <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->part }}</td>
                <td>{{ $post->user_id }}</td>
                <td><a href="{{ url('posts/' . $post->id) }}" class="btn btn-info">詳細</a></td>
                <td><a href="{{ url('posts/' . $post->id . '/edit') }}" class="btn btn-primary">編集</a></td>
                <td>
                  <form method="POST" action="/posts/{{ $post->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">削除</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
