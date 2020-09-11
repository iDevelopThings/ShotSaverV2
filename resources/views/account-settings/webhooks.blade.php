@extends('account-settings.layout')

@section('page-content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            Change Webhook URL
        </div>
        <form action="{{route('settings.save-webhooks')}}" method="post">
            {{csrf_field()}}

            <div class="card-body">

                <div class="form-group{{ $errors->has('webhook_url') ? ' has-error' : '' }}">
                    <label for="webhook_url" class="control-label">Webhook URL</label>

                    <input id="webhook_url"
                           type="url"
                           class="form-control"
                           name="webhook_url"
                           value="{{ old('webhook_url', auth()->user()->webhook_url) }}"
                           autofocus>

                    @if ($errors->has('webhook_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('webhook_url') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('webhook_key') ? ' has-error' : '' }}">
                    <label for="webhook_key" class="control-label">Webhook Key</label>
                    <p>This will be used to secure the request to your server. Set a custom one or one will be generated.</p>

                    <input id="webhook_key"
                           type="text"
                           class="form-control"
                           name="webhook_key"
                           value="{{ old('webhook_key', auth()->user()->webhook_key) }}"

                           >

                    @if ($errors->has('webhook_key'))
                        <span class="help-block">
                            <strong>{{ $errors->first('webhook_key') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" type="submit">
                    Update Webhook URL
                </button>
            </div>
        </form>
    </div>
@endsection
