@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-shield"></i> Roles</h1>
                <p>User &amp; Role Management</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users &amp; Roles</a></li>
                <li class="breadcrumb-item"><a href="{{ route('role.create') }}">Create role</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">New Role</h3>
                    <div class="tile-body">
                        <form class="row" method="post" action="{{ route('role.store') }}">
                            @csrf
                            <div class="form-group col-md-3">
                                <label class="control-label">Name</label>
                                <input required style="height: 58px;" name="name" value="{{ old('name') }}" class="form-control" type="text" placeholder="Enter role name">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Description</label>
                                <textarea required style="resize: none;" name="description" value="{{ old('description') }}" class="form-control" placeholder="Enter role description"></textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Minimum Purchase (RM)</label>
                                <input required style="height: 58px;" name="min_purchase" value="{{ old('min_purchase') }}" class="form-control" type="number" placeholder="Enter purchase amount per month">
                            </div>
                            <div class="form-group col-md-3 align-self-end">
                                <button class="btn btn-primary" row="1" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Now</button>
                            </div>
                        </form>
                    </div>
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