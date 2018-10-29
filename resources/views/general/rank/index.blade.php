@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Team Members</h1>
                <p>My team members</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('team') }}">Team Memeber</a></li>
            </ul>
        </div>

        {{-- Team Members --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">My team members</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="teamMember">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>HP</th>
                                <th>Picture</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $team)
                                    <tr>
                                        <td>{{ $team->user->name }}</td>
                                        <td>{{ $team->user->email }}</td>
                                        <td>{{ $team->hp }}</td>
                                        <td><img width="50px" height="50px" src="{{ asset('storage/'.$team->picture) }}"></td>
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
    <script type="text/javascript">
        $('#teamMember').DataTable();
    </script>
@endsection