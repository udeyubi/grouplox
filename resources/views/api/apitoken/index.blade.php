@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center flex-column text-center">
        @empty(session('token'))
    
        @else
            這是您的token，請妥善保管，離開頁面後將無法再次取得
            <div class="text-danger bg-black-50 mb-2 px-1">{{ session()->get('token') }}</div>
        @endempty

        <a href="{{ route('api.dashboard.index') }}" class="btn btn-secondary w-25">返回儀錶板</a>
    </div>
@endsection
