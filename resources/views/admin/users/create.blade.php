@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-users"></i> Users</h1>
                <p>User &amp; Role Management</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users &amp; Roles</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.create') }}">Create user</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Register New User</h3>
                    <div class="tile-body">
                        <form class="form-horizontal" method="post" action="{{ route('user.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3">Name</label>
                                <div class="col-md-8">
                                    <input required value="{{ old('name') }}" class="form-control" name="name" type="text" placeholder="Enter full name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-8">
                                    <input value="{{ old('email') }}" class="form-control col-md-8" name="email" type="email" placeholder="Enter email address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-8">
                                    <input required class="form-control col-md-8" name="password" id="password" type="password" placeholder="Enter password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Password Confirmation</label>
                                <div class="col-md-8">
                                    <input required class="form-control col-md-8" type="password" id="password-confirm" name="password_confirmation" placeholder="Re-enter password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Administrator</label>
                                <div class="col-md-9">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input checked class="form-check-input" type="radio" value="0" name="admin">No
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio"  value="1" name="admin">Yes
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Referral HP</label>
                                <div class="col-md-8">
                                    <input value="{{ old('references') }}" class="form-control" name="references" type="tel" placeholder="Who recommended you? Empty if non.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Stockist Type</label>
                                <div class="col-md-8">
                                    <select required name="role" id="role">
                                        <option value="">Please Choose</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }} || Min Spending / Month RM {{ number_format($role->min_purchase,2) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>
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
    </script>
@endsection