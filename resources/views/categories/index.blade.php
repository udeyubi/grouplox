@extends('layouts.app')

@section('content')
    <a href="{{ route('categories.create') }}" class="btn btn-outline-dark mb-2"> 建立分類 </a>

    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="text-center">
            <tr>
                <th scope="col" class="col-1">#</th>
                <th scope="col" class="col-2">分類名稱</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td >{{ $category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection