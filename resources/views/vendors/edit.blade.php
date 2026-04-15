@extends('layouts.app')
@section('title')
    {{__('messages.vendor.edit_vendor')}}
@endsection
@section('content')
    @php $styleCss = 'style'; @endphp
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                    <a class="btn btn-outline-primary float-end"
                       href="{{ route('vendors.index') }}">{{ __('messages.common.back') }}</a>
                </div>
                <div class="col-12">
                    @include('layouts.errors')
                </div>
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($vendor, ['route' => ['vendors.update', $vendor->id], 'method' => 'PUT', 'files' => 'true', 'id' => 'vendorForm']) }}
                        @include('vendors.edit_fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::hidden('is_edit', true ,['id' => 'isEdit']) }}
    {{ Form::hidden('default_avatar_image_url', asset('assets/images/avatar.png'),['id' => 'defaultAvatarImageUrl']) }}
    {{ Form::hidden('country_id', $vendor->country_id,['id' => 'vendorCountryId']) }}
    {{ Form::hidden('state_id', $vendor->state_id ,['id' => 'vendorStateId']) }}
    {{ Form::hidden('city_id', $vendor->city_id ,['id' => 'vendorCityId']) }}
@endsection
@section('phone_js')
    <script>
        phoneNo = "{{ $vendor->user->region_code.$vendor->user->contact }}"
    </script>
@endsection
