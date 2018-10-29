@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-shopping-cart"></i> My cart</h1>
                <p>Shopping cart list</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
                <li class="breadcrumb-item"><a href="{{ route('all_item') }}">Items In Cart</a></li>
            </ul>
        </div>

        {{-- Team Members --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-6">Products in cart | Total: RM {{ number_format($total, 2) }}</div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-info" href="{{ route('checkout') }}">Proceed Checkout</a>
                            </div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="teamMember">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price / Unit</th>
                                <th>Sub total</th>
                                <th>Add Quantity</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>RM {{ $item->price }}</td>
                                    <td>RM {{ number_format($item->price * $item->quantity, 2) }}</td>
                                    <td width="10%" class="text-center">

                                        <form method="post" action="{{ route('add_quantity') }}">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <input style="width: 50px;" type="number" name="add_quantity">
                                            <button style="cursor: pointer" type="submit"><i class="fa fa-plus-square"></i></button>
                                        </form>

                                    </td>
                                    <td><a href="{{ route('remove_item', ['id' => $item->id]) }}">Remove Item</a></td>
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