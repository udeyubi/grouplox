@extends('layouts.app')

<style>
    table{
        table-layout: fixed;
    }

    td{
        
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
</style>

@section('content')
    <h4>後臺管理</h4>
    <div class="d-flex justify-content-end my-3">
        <a href="{{ route('shop.commodities.create') }}" class="btn btn-primary mx-3"> 建立商品 </a>
    </div>

    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="text-center">
            <tr>
                <th scope="col" class="col-1">#</th>
                <th scope="col" class="col-2">商品名稱</th>
                <th scope="col" class="col-2">售價</th>
                <th scope="col" class="col-6">商品描述</th>
                <th scope="col" class="col-1">功能</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commodities as $commodity)
                <tr>
                    <th scope="row" class="text-center">{{ $commodity->id }}</th>
                    <td>{{ $commodity->name }}</td>
                    <td>{{ $commodity->price }}</td>
                    <td style="white-space: nowrap;text-overflow:ellipsis">{{ $commodity->description }}</td>
                    <td class="text-center">
                        <a href="{{ route('shop.commodities.edit',$commodity->id) }}" class="btn btn-outline-primary btn-sm">
                            修改
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection