@extends('layouts.app')

@php
$__currentRouteName = Route::currentRouteName();
@endphp

@push('styles')
    @style('/css/settings.css')
@endpush

@section('content')

    <h2><span class="fas fa-cog"></span> My Settings</h2>

    <div class="row settings">

        <div class="col-12 col-sm-5 col-md-4 col-lg-3">
            <div class="list-group settings-nav">
                <a class="list-group-item list-group-item-action {{ ($__currentRouteName == 'my-settings.index') ? 'current' : '' }}" href="{{ route('my-settings.index') }}">Details</a>
                {{--<a class="list-group-item list-group-item-action" href="#">Password</a>
                <a class="list-group-item list-group-item-action" href="#">Photo</a>
                <a class="list-group-item list-group-item-action" href="#">Settings</a>--}}
            </div>
        </div>

        <div class="col-12 col-sm-7 col-md-8 col-lg-9 mt-4 mt-sm-0">
            <div class="card">
                <div class="card-body">

                    @yield('my-settings-content')

                </div>
            </div>
        </div>

    </div>

@endsection
