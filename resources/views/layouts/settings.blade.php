@extends('layouts.app')

@php
$__currentRouteName = Route::currentRouteName();
@endphp

@push('styles')
    @style('/css/settings.css')
@endpush

@section('content')

    <h1>{!! \App\icon\mySettings(['mr-2']) !!}{{ __('app.mySettings') }}</h1>

    <div class="row settings">

        <div class="col-12 col-sm-4 col-md-3">
            <div class="list-group settings-nav">
                <a class="list-group-item list-group-item-action {{ ($__currentRouteName == 'my-settings.index')    ? 'current' : '' }}" href="{{ route('my-settings.index') }}   ">{!! \App\icon\myDetails(['fa-fw', 'mr-2'])  !!}{{ __('settings.details') }}</a>
                <a class="list-group-item list-group-item-action {{ ($__currentRouteName == 'my-settings.password') ? 'current' : '' }}" href="{{ route('my-settings.password') }}">{!! \App\icon\myPassword(['fa-fw', 'mr-2']) !!}{{ __('settings.password') }}</a>
                <a class="list-group-item list-group-item-action {{ ($__currentRouteName == 'my-settings.photo')    ? 'current' : '' }}" href="{{ route('my-settings.photo') }}   ">{!! \App\icon\myPhoto(['fa-fw', 'mr-2'])    !!}{{ __('settings.photo') }}</a>
            </div>

            <div class="list-group settings-nav mt-3">
                <a class="list-group-item list-group-item-action {{ ($__currentRouteName == 'my-settings.teams') ? 'current' : '' }}" href="{{ route('my-settings.teams') }}">{!! \App\icon\teams(['fa-fw', 'mr-2']) !!}{{ __('app.teams') }}</a>
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
