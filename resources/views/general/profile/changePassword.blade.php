@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-users"></i> Users</h1>
                <p>User Profile | Change password</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">My Profile</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="row tile-title">
                        <div class="col-md-12">Change password for {{ Auth::user()->name }}</div>
                    </div>

                    <div class="tile-body">
                        <form class="form-horizontal" method="post" action="{{ route('password.update', Auth::user()->id) }}">
                            @csrf

                            <input name="_method" type="hidden" value="PATCH">

                            <div class="form-group row">
                                <label class="control-label col-md-3">Current password</label>
                                <div class="col-md-8">
                                    <input required class="form-control" name="current_password" type="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">New Password</label>
                                <div class="col-md-8">
                                    <input required class="form-control" name="password" type="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">New password again</label>
                                <div class="col-md-8">
                                    <input required class="form-control" name="password_confirmation" type="password">
                                </div>
                            </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update info</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{ asset('theme/js/plugins/bootstrap-notify.min.js') }}"></script>
    <script>
        @if (count($errors) > 0)
        @foreach($errors->all() as $error)
        $.notify({
            title: "Errors : ",
            message: "{{ $error }}",
            icon: 'fa fa-times'
        },{
            type: "danger"
        });
        @endforeach
        @endif

        // Displaying success message
        @if (session('status'))
        $.notify({
            title: "Info : ",
            message: "{{ session('status') }}",
            icon: 'fa fa-check'
        },{
            type: "info"
        });
        @endif
    </script>
@endsection