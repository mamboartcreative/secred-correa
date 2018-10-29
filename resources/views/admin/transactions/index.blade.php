@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-credit-card-alt"></i> Transactions</h1>
                <p>All transactions detail back from eGHL</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('transactions') }}">Transactions</a></li>
            </ul>
        </div>

        {{--Transaction list--}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-12">Transaction references</div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="transactions">
                            <thead>
                            <tr>
                                <th>PG Ref</th>
                                <th>Order Id</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>View Order</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td><img width="80px" height="80px" src="{{ asset('storage/'.$transaction->references) }}" alt=""></td>
                                    <td>{{ $transaction->order_id }}</td>
                                    <td>RM {{ $transaction->amount }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->remarks }}</td>
                                    <td><a class="btn btn-primary btn-sm" href="{{ route('order.details', [$transaction->order_id]) }}"><i class="fa fa-search-plus"></i> View order</a></td>
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
        $('#transactions').DataTable();
    </script>
@endsection