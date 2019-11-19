@extends('layouts.app')

@php
$__currentRouteName = Route::currentRouteName();
@endphp

@push('styles')
    @style('/css/settings.css')
@endpush

@section('content')

    <h1><span class="fas fa-cog"></span> My Settings</h1>

    <div class="row settings">

        <div class="col-12 col-sm-4 col-md-3">
            <div class="list-group settings-nav">
                <a class="list-group-item list-group-item-action {{ ($__currentRouteName == 'my-settings.index') ? 'current' : '' }}" href="{{ route('my-settings.index') }}"><span class="fa-fw far fa-address-card"></span> Details</a>
                <a class="list-group-item list-group-item-action {{ ($__currentRouteName == 'my-settings.password') ? 'current' : '' }}" href="{{ route('my-settings.password') }}"><span class="fa-fw fas fa-user-shield"></span> Password</a>
                <a class="list-group-item list-group-item-action" href="#"><span class="fa-fw fas fa-portrait"></span> Photo</a>
                {{--<a class="list-group-item list-group-item-action" href="#">Settings</a>--}}
            </div>
        </div>

        <div class="col-12 col-sm-8 col-md-9 mt-4 mt-sm-0">
            <div class="card">
                <div class="card-body">

                    @yield('my-settings-content')

                </div>
            </div>
        </div>

    </div>

@endsection
