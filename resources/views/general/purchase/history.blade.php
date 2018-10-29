@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-shopping-bag"></i> Purchase</h1>
                <p>View all purchased history data</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('history') }}">Purchase History</a></li>
            </ul>
        </div>

        {{-- Pending orders --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">My All Orders</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="history">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Total Amount</th>
                                <th>Tracking Id</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>View Order</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($histories as $orders)
                                <tr>
                                    <td>{{ $orders->id }}</td>
                                    <td>RM {{ $orders->total }}</td>
                                    <td>{{ $orders->tracking_id }}</td>
                                    <td>{{ $orders->remark }}</td>
                                    <td>{{ $orders->status }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('order.details.user', [$orders->id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
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
        $('#history').DataTable();
    </script>
@endsection