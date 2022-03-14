@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <a href="{{ route('api.dashboard.index') }}" class="btn btn-outline-dark"> api </a>
    </div>
@endsection