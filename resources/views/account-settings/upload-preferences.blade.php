@extends('account-settings.layout')

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('page-content')

    <div class="card">
        <div class="card-header">
            Your preferences
        </div>
        <form action="{{route('settings.save-upload-preferences')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="setting-item">
                    <div class="explainer">
                        <strong>
                            Make my uploads private
                        </strong>
                        <p>
                            When you upload to the platform, this feature will set your uploads to public/private
                            by default. <strong>You can edit each file and change their privacy setting also, this will
                                                just assign a default privacy setting.</strong>
                        </p>
                    </div>
                    <div class="setting-toggle">
                        <input type="checkbox"
                               name="private"
                               {{auth()->user()->private_uploads ? 'checked' : ''}} id="toggle">
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary">
                    Save Preferences
                </button>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('#toggle').bootstrapToggle({
                on       : 'Private',
                off      : 'Public',
                onstyle  : 'success',
                offstyle : 'danger'
            });
        })
    </script>
@endsection
