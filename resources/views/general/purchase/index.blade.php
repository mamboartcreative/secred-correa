@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-shopping-bag"></i> Products</h1>
                <p>Shop online for stockist</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
            </ul>
        </div>

        {{-- Data Users --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-6">List of Products</div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary" href="{{ route('all_item') }}">{{ $cartCount }} items in cart</a>
                                <a class="btn btn-primary" href="{{ route('clear_cart') }}">Clear cart</a>
                            </div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="itemsData">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th width="8%">Price</th>
                                <th>Description</th>
                                <th>Picture</th>
                                <th width="10%" class="text-center">Add to cart</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <th>{{ $item->name }}</th>
                                    <th>RM {{ $item->selling_price }}</th>
                                    <th>{{ $item->description }}</th>
                                    <th><img width="50px" height="50px" src="{{ asset('storage/'.$item->picture ) }}" alt="{{ $item->name }}"></th>
                                    <td class="text-center">
                                        <a href="{{ route('add_cart', ['id' => $item->id]) }}"><i class="fa fa-cart-plus fa-lg"></i></a>
                                    </td>
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
        $('#itemsData').DataTable();

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