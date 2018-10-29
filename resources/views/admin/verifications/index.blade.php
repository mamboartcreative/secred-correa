@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-shield"></i> Verification Code</h1>
                <p>Add new verification code</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('verification.index') }}">Verification Code</a></li>
            </ul>
        </div>



        {{-- Verification List --}}
        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">Add new code</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <form method="post" action="{{ route('verification.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-8">
                                    <input required value="{{ old('email') }}" class="form-control" name="email" type="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Code</label>
                                <div class="col-md-8">
                                    <input required value="{{ old('code') }}" class="form-control" name="code" type="text">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">Verification code lists</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="verifications">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Code</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($verifications as $verification)
                                    <tr>
                                        <td>{{ $verification->email }}</td>
                                        <td>{{ $verification->code }}</td>
                                        <td>{{ $verification->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('custom-js')
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('theme/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/plugins/bootstrap-notify.min.js') }}"></script>
    <script type="text/javascript">
        $('#verifications').DataTable();

        // Displaying success message
        @if (session('status'))
            $.notify({
                title: "Completed : ",
                message: "{{ session('status') }}",
                icon: 'fa fa-check'
            },{
                type: "success"
            });
        @endif

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