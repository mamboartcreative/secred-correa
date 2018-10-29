@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
                <p>Orders, purchases &amp; other related details</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashborad</a></li>
            </ul>
        </div>

        {{-- Widget Counter --}}
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Team members</h4>
                        <p><b>{{ $teamMember }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-dollar fa-3x"></i>
                    <div class="info">
                        <h4>Monthly RM{{ $minPurchase }}</h4>
                        <p><b>SPENT: RM {{ $expenses }}</b></p>
                    </div>
                </div>
            </div>
            {{--<div class="col-md-6 col-lg-3">--}}
                {{--<div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>--}}
                    {{--<div class="info">--}}
                        {{--<h4>Uploades</h4>--}}
                        {{--<p><b>10</b></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 col-lg-3">--}}
                {{--<div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>--}}
                    {{--<div class="info">--}}
                        {{--<h4>Stars</h4>--}}
                        {{--<p><b>500</b></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

        {{-- Unpaid orders --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">My Unpaid Orders</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="unpaid">
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
                            @foreach($getUnpaidOrders as $getUnpaidOrder)
                                <tr>
                                    <td>{{ $getUnpaidOrder->id }}</td>
                                    <td>RM {{ $getUnpaidOrder->total }}</td>
                                    <td>{{ $getUnpaidOrder->tracking_id }}</td>
                                    <td>{{ $getUnpaidOrder->remark }}</td>
                                    <td>{{ $getUnpaidOrder->status }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('create.payment', [$getUnpaidOrder->id]) }}"><i class="fa fa-university"></i> Do payment</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending orders --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">My Pending Orders</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="pendingOrders">
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
                                @foreach($pendingOrders as $pendingOrder)
                                    <tr>
                                        <td>{{ $pendingOrder->id }}</td>
                                        <td>RM {{ $pendingOrder->total }}</td>
                                        <td>{{ $pendingOrder->tracking_id }}</td>
                                        <td>{{ $pendingOrder->remark }}</td>
                                        <td>{{ $pendingOrder->status }}</td>
                                        <td><a class="btn btn-primary btn-sm" href="{{ route('order.details.user', [$pendingOrder->id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Canceled orders --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">My Canceled Orders</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="canceledOrders">
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
                            @foreach($canceledOrders as $canceledOrder)
                                <tr>
                                    <td>{{ $canceledOrder->id }}</td>
                                    <td>RM {{ $canceledOrder->total }}</td>
                                    <td>{{ $canceledOrder->tracking_id }}</td>
                                    <td>{{ $canceledOrder->remark }}</td>
                                    <td>{{ $canceledOrder->status }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('order.details.user', [$canceledOrder->id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
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
        $('#pendingOrders').DataTable();
        $('#canceledOrders').DataTable();
        $('#unpaid').DataTable();

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