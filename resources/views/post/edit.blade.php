@extends("layouts.app")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                編集画面
            </div>
            <div class="card-body">
                <form method="POST" action="/posts/{{ $post->id }}" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id" class="control-label">ID</label>
                        <div>{{ $post->id }}</div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="title" class="control-label">タイトル</label>
                        <input class="form-control" name="title" type="text" value="{{ $post->title }}">
                    </div>
                    <div class="form-group">
                        <label for="title" class="control-label">部位</label>
                        <input class="form-control" name="part" type="text" value="{{ $post->part }}">
                    </div>
                    <hr>
                    <button class="btn btn-primary" type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
