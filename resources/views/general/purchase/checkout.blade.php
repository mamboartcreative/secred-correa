@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-users"></i> Checkout</h1>
                <p>Check out</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('checkout') }}">Check out</a></li>
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

                    <div class="row tile-title">
                        <div class="col-md-6">Shipping address</div>
                        <div class="col-md-6 text-right">Total: RM {{ number_format($total, 2) }}</div>
                    </div>

                    <div class="tile-body">
                        <form class="form-horizontal" method="post" action="{{ route('do.checkout') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3">HP</label>
                                <div class="col-md-8">
                                    <input required value="{{ Auth::user()->profile->hp }}" class="form-control" name="hp" type="tel">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-8">
                                    <input required value="{{ Auth::user()->profile->address }}" class="form-control" name="address" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">City</label>
                                <div class="col-md-8">
                                    <input required value="{{ Auth::user()->profile->city }}" class="form-control" name="city" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Postcode</label>
                                <div class="col-md-8">
                                    <input required value="{{ Auth::user()->profile->postcode }}" class="form-control" name="postcode" type="number" placeholder="00000">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">State</label>
                                <div class="col-md-8">
                                    <input required value="{{ Auth::user()->profile->state }}" class="form-control" name="state" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Remark</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="remark" type="text">
                                </div>
                            </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Check out now</button>
                            </div>
                        </div>
                    </div>
                    </form>
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

        // Displaying success message
        @if (session('status'))
        $.notify({
            title: "Info : ",
            message: "{{ session('status') }}",
            icon: 'fa fa-check'
        },{
            type: "info"
        });
        @endif
    </script>
@endsection