@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
                <p>Order details</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('order.details.user', [$lists->id]) }}">Invoice</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"><i class="fa fa-globe"></i> SC GLOBAL RESOURCES SDN BHD (1157221-X) </h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Date: {{$lists->created_at->format('d/m/Y')}}</h5>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">From
                                <address><strong>Secret Correa</strong>5-5-03 Jalan Medan,<br> Pusat Bandar 8A, Bangi Sentral,<br>43650 Bandar Baru Bangi,<br> ​Selangor, Malaysia.</address>
                            </div>
                            <div class="col-4">To
                                <address><strong>{{ $user->name }}</strong><br>{{ $user->profile->address }}<br>{{ $user->profile->postcode }} {{ $user->profile->city }}<br>{{ $user->profile->state }}<br>Phone: {{ $user->profile->hp }}<br>Email: {{ $user->email }}</address>
                            </div>
                            <div class="col-4"><b>Invoice #{{ $lists->id }}</b><br><br><b>Order ID:</b> {{ $lists->id }}<br><b>Status:</b> {{ $lists->status }}<br><b>Total:</b> RM {{ number_format($total, 2) }}</div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal (RM)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $cart->name }}</td>
                                            <td>{{ $cart->price }}</td>
                                            <td>{{ $cart->quantity }}</td>
                                            <td>{{ number_format($cart->quantity * $cart->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
                        </div>
                    </section>
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

        //error
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