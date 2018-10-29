@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-cart-arrow-down"></i> Orders</h1>
                <p>View all orders</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></li>
            </ul>
        </div>

        {{-- orders --}}
        <div class="row">
            <div class="col-md-6">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">New Orders</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="new">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Total Amount</th>
                                <th>Tracking Id</th>
                                <th>Status</th>
                                <th>View Order</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $new)
                                <tr>
                                    <td>{{ $new->id }}</td>
                                    <td>RM {{ $new->total }}</td>
                                    <td>{{ $new->tracking_id }}</td>
                                    <td>{{ $new->status }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('order.details', [$new->id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">In Progress</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="inProgress">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Total Amount</th>
                                <th>Tracking Id</th>
                                <th>Status</th>
                                <th>View Order</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inProgresss as $inProgress)
                                <tr>
                                    <td>{{ $inProgress->id }}</td>
                                    <td>RM {{ $inProgress->total }}</td>
                                    <td>{{ $inProgress->tracking_id }}</td>
                                    <td>{{ $inProgress->status }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('order.details', [$inProgress->id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- orders --}}
        <div class="row">
            <div class="col-md-6">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">Cancelled Order</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="cancel">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Total Amount</th>
                                <th>Tracking Id</th>
                                <th>Status</th>
                                <th>View Order</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($canceleds as $canceled)
                                <tr>
                                    <td>{{ $canceled->id }}</td>
                                    <td>RM {{ $canceled->total }}</td>
                                    <td>{{ $canceled->tracking_id }}</td>
                                    <td>{{ $canceled->status }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('order.details', [$canceled->id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">Unpaid Order</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="unpaid">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Total Amount</th>
                                <th>Tracking Id</th>
                                <th>Status</th>
                                <th>View Order</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unpaidOrders as $unpaidOrder)
                                <tr>
                                    <td>{{ $unpaidOrder->id }}</td>
                                    <td>RM {{ $unpaidOrder->total }}</td>
                                    <td>{{ $unpaidOrder->tracking_id }}</td>
                                    <td>{{ $unpaidOrder->status }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('order.details', [$unpaidOrder->id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- orders --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">All Orders</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="all">
                            <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Total Amount</th>
                                <th>Tracking Id</th>
                                <th>Status</th>
                                <th>View Order</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alls as $all)
                                <tr>
                                    <td>{{ $all->id }}</td>
                                    <td>RM {{ $all->total }}</td>
                                    <td>{{ $all->tracking_id }}</td>
                                    <td>{{ $all->status }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('order.details', [$all->id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
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
        $('#new').DataTable();
        $('#inProgress').DataTable();
        $('#cancel').DataTable();
        $('#all').DataTable();
        $('#unpaid').DataTable();
    </script>
@endsection