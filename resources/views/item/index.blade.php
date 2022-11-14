@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <div class="search">
        <form action="/item/search" method="GET">
            <div class="row">
                <div class="col-6"><h1>商品一覧</h1></div>
                <div class="col-5">
                    <input type="search" class="form-control" placeholder="入力" name="keyword" value="{{ $keyword }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col" width="12%">ID</th>
                                <th scope="col" width="20%">名前</th>
                                <th scope="col" width="12%">分類</th>
                                <th scope="col" width="12%">著者</th>
                                <th scope="col" width="12%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{!! nl2br($item->name) !!}</td>
                                    <td>{{ App\Models\Item::TYPE[$item->type] }}</td>
                                    <td>{!! nl2br($item->detail) !!}</td>
                                    <td><a href="/item/edit/{{ $item->id }}" class="btn btn-primary btn-sm">編集</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="mx-4">
            {{ $items->appends(request()->query())->Links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
