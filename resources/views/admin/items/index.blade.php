@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-shopping-bag"></i> Items</h1>
                <p>Items Management</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('item.index') }}">Items</a></li>
            </ul>
        </div>

        {{-- Data Users --}}
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                    <div class="tile-title">
                        <div class="row">
                            <div class="col-md-6">List of Items</div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('item.create') }}" class="btn btn-primary">Add Item</a>
                            </div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="itemsData">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Cost Price</th>
                                <th>Selling Price</th>
                                <th>Picture</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <th>{{ $item->name }}</th>
                                    <th>{{ $item->quantity }}</th>
                                    <th>{{ $item->description }}</th>
                                    <th>{{ $item->cost_price }}</th>
                                    <th>{{ $item->selling_price }}</th>
                                    <th><img width="50px" height="50px" src="{{ asset('storage/'.$item->picture ) }}" alt="{{ $item->name }}"></th>
                                    <th>
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </th>
                                    <td></td>
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