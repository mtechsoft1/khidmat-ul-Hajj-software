@extends('layouts.app')
@section('title')
    {{__('messages.vendor.vendor_details')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-end mb-5">
                    <h1>@yield('title')</h1>
                    <div>
                        <a href="{{ route('vendors.index') }}" class="btn btn-outline-primary">
                            {{ __('messages.common.back') }}
                        </a>
                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-primary">
                            {{ __('messages.common.edit') }}
                        </a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @include('vendors.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
