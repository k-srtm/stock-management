@extends('adminlte::page')

@section('title', '商品編集 / 削除')

@section('content_header')
    <h1>商品編集 / 削除</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form action="/itemEdit" method="POST">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{$items->id}}">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$items->name}}">
                        </div>

                        <div class="form-group">
                            <label for="type">分類</label>
                            <select class="form-control" name="type" required>
                                <option value=""></option>
                                @foreach($type as $key=>$value)
                                <option value="{{$key}}" @if($key==$items->type) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">著者</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="{{$items->detail}}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">編集</button>
                        <a class="btn btn-primary" href="/itemDelete/{{$items->id}}">削除</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
