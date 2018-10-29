@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-users"></i> Users &amp; Roles</h1>
                <p>User &amp; Role Management</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users &amp; Roles</a></li>
            </ul>
        </div>

        {{-- Data Users --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-6">List of Users</div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>
                            </div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="usersData">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>NRIC</th>
                                <th>HP</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>Referred</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->profile->ic }}</td>
                                        <td>{{ $user->profile->hp }}</td>
                                        <td>{{ $user->profile->address}}, {{  $user->profile->postcode }} {{  $user->profile->city }}</td>
                                        <td>{{ $user->profile->state }}</td>
                                        <td>{{ $user->profile->references }}</td>
                                        <td>
                                            @foreach($user->role as $role)
                                                {{ $role->name }} @if($user->admin == 1) | Admin @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $user->created_at->format('d/m/y') }}</td>
                                        <td><a title="View sales" href="{{ route('user.orders', ['id' => $user->id]) }}"><i class="fa fa-dollar"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{--Data Roles--}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-6">List of Roles</div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('role.create') }}" class="btn btn-primary">Add Role</a>
                            </div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="rolesData">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Min Purchase / Month</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td class="text-right">RM {{ number_format($role->min_purchase, 2) }}</td>
                                        <td>{{ '' }}</td>
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
        // Data tables
        $('#usersData').DataTable();
        $('#rolesData').DataTable();

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
    </script>
@endsection