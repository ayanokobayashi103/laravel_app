@extends("layouts.app")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                詳細画面
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>id</th>
                            <td>{{$post->id}}</td>
                        </tr>
                        <tr>
                            <th>title</th>
                            <td>{{$post->title}}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ url('posts') }}" class="btn btn-info">戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
