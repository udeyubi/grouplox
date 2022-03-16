@extends('layouts.app')

@section('content')
    <h4>後臺管理</h4>
    <div class="d-flex justify-content-center">
        <a href="{{ route('shop.commodities.create') }}" class="btn btn-outline-dark mx-3"> 建立商品 </a>
    </div>
@endsection