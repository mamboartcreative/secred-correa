@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-shopping-cart"></i> Order Details</h1>
                <p>Order details</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('create.payment', [$lists->id]) }}">Update references</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">Please do transfer the exact total amount to <b>MBB account number 123456456789</b></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-6">Order id : {{ $lists->id }} || Total: RM {{ number_format($total, 2) }} || Status: {{ $lists->status }}</div>
                        </div>
                    </div>

                    <div class="tile-body">

                        <div class="row">
                            <div class="col-md-6">
                                <p>To:</p>
                                <p>{{ $user->name }}</p>
                                <p style="margin: 0px;">{{ $user->profile->address }}</p>
                                <p>{{ $user->profile->postcode }} {{ $user->profile->city }} {{ $user->profile->state }}</p>
                                <p>HP: {{ $user->profile->hp }} | Email:  {{ $user->email }}</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <form class="form-horizontal" method="post" action="{{ route('make.payment') }}" enctype="multipart/form-data">

                                    @csrf

                                    <input name="id" type="hidden" value="{{ $lists->id }}">

                                    <div class="form-group row">
                                        <label class="control-label col-md-3">References</label>
                                        <div class="col-md-8">
                                            <input required class="form-control" name="picture" type="file">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Payment Prove</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
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