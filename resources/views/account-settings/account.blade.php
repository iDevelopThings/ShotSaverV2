@extends('account-settings.layout')

@section('page-content')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Change Password
        </div>
        <form action="{{route('settings.save-account')}}" method="post">
            {{csrf_field()}}

            <div class="card-body">

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>

                    <input id="password"
                           type="password"
                           class="form-control"
                           name="password"
                           value="{{ old('password') }}"
                           required
                           autofocus>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password_confirmation" class="control-label">Password Confirm</label>

                    <input id="password_confirmation"
                           type="password"
                           class="form-control"
                           name="password_confirmation"
                           value="{{ old('password_confirmation') }}"
                           required
                           autofocus>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                    @endif
                </div>

            </div>

            <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit">
                    Change Password
                </button>
            </div>
        </form>
    </div>

@endsection
