@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center flex-column text-center">
        <h3> API 儀錶板 </h3>
        <form action="{{ route('api.apitoken.generate') }}" method="POST" class="mb-3">
            @CSRF
            <button type="submit" class="btn btn-success">生成token</button>
        </form>

        <div>
            <h5> 服務狀態 </h5>
            <api-status-switches api-status-name="service" :api-status={{ $api_is_serving }} api-status-description="服務"></api-status-switches>
            <api-status-switches api-status-name="validate" :api-status={{ $api_need_validate }} api-status-description="驗證"></api-status-switches>
            {{-- <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">服務</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">驗證</label>
            </div> --}}
        </div>
    </div>
    {{-- <example-component :lulu-man = {{ $api_isserving }}></example-component>
    <example-component :lulu-man = {{ $api_validate }}></example-component> --}}
@endsection