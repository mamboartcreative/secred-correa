@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-users"></i> Users</h1>
                <p>User Profile</p>
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
                        <div class="col-md-6">{{ Auth::user()->name }}</div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('change.password', ['id' => Auth::user()->id]) }}" class="btn btn-primary">Change password</a>
                        </div>
                    </div>

                    <div class="tile-body">
                        <form class="form-horizontal" method="post" action="{{ route('user.update', Auth::user()->id) }}" enctype="multipart/form-data">
                            @csrf

                            <input name="_method" type="hidden" value="PATCH">

                            <div class="form-group row">
                                <label class="control-label col-md-3">NRIC</label>
                                <div class="col-md-8">
                                    <input required value="{{ $profile->ic }}" class="form-control" name="ic" type="tel" placeholder="xxxxxxxxxxxx">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">HP</label>
                                <div class="col-md-8">
                                    <input required value="{{ $profile->hp }}" class="form-control" name="hp" type="tel">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-8">
                                    <input required value="{{ $profile->address }}" class="form-control" name="address" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">City</label>
                                <div class="col-md-8">
                                    <input required value="{{ $profile->city }}" class="form-control" name="city" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Postcode</label>
                                <div class="col-md-8">
                                    <input required value="{{ $profile->postcode }}" class="form-control" name="postcode" type="number" placeholder="00000">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">State</label>
                                <div class="col-md-8">
                                    <input required value="{{ $profile->state }}" class="form-control" name="state" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Profile Picture</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="picture" type="file">
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