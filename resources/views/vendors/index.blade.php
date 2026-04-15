@extends('layouts.app')
@section('title')
    {{__('messages.vendors')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column  ">
            @include('flash::message')
            <livewire:vendor-table/>
        </div>
    </div>
@endsection
