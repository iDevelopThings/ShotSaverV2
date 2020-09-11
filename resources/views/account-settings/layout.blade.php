@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <strong>Navigation</strong>
                <ul class="settings-nav">
                    <li>
                        <a href="{{route('settings.account')}}"
                           @if(request()->routeIs('settings.account')) class="active" @endif >
                            Account
                        </a>
                    </li>
                    <li>
                        <a href="{{route('settings.api')}}"
                           @if(request()->routeIs('settings.api')) class="active" @endif >
                            Api
                        </a>
                    </li>
                    <li>
                        <a href="{{route('settings.upload-preferences')}}"
                           @if(request()->routeIs('settings.upload-preferences')) class="active" @endif>
                            Preferences
                        </a>
                    </li>
                    <li>
                        <a href="{{route('settings.webhooks')}}"
                           @if(request()->routeIs('settings.webhooks')) class="active" @endif>
                            Webhooks
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">

                @yield('page-content')

            </div>
        </div>
    </div>
@endsection
