@extends('master.layout')

@section('title', 'Dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-shopping-bag"></i> Item</h1>
                <p>Add new item</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="{{ route('item.index') }}">Items</a></li>
                <li class="breadcrumb-item"><a href="{{ route('item.create') }}">New Item</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Add item / product</h3>
                    <div class="tile-body">
                        <form class="form-horizontal" method="post" action="{{ route('item.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label class="control-label col-md-3">Name</label>
                                <div class="col-md-8">
                                    <input required value="{{ old('name') }}" class="form-control" name="name" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-8">
                                    <input required value="{{ old('description') }}" class="form-control" name="description" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3" for="cost_price">Cost Price</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend"><span class="input-group-text">RM</span></div>
                                    <input min="1" required value="{{ old('cost_price') }}" class="form-control" id="cost_price" name="cost_price" type="number">
                                    <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3" for="selling_price">Selling Price</label>
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend"><span class="input-group-text">RM</span></div>
                                    <input min="1" required value="{{ old('selling_price') }}" class="form-control" id="selling_price" name="selling_price" type="number">
                                    <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="control-label col-md-3">Quantity</label>
                                <div class="col-md-8">
                                    <input min="1" required value="{{ old('quantity') }}" class="form-control" name="quantity" type="number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Type</label>
                                <div class="col-md-8">
                                    <select required name="type" id="type">
                                        <option value="">Please Select</option>
                                        <option value="LOSYEN">Losyen</option>
                                        <option value="KOPI">Kopi</option>
                                        <option value="TRIM">Trim</option>
                                        <option value="DETOX">Detox</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Product Image</label>
                                <div class="col-md-8">
                                    <input required class="form-control" name="picture" type="file">
                                </div>
                            </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
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