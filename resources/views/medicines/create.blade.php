@extends('adminlte::page')

@section('title', 'Add Medicine')

@section('content')

<div class="card mt-3  card-outline card-primary">

    <div class="card-header">
        <h3 class="card-title">Add Medicine</h3>
    </div>

    <form method="POST" action="{{ route('medicines.store') }}">
        @csrf

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Medicine Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="medicine_name"
                               class="form-control"
                               value="{{ old('medicine_name') }}"
                               required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Generic Name</label>
                        <input type="text"
                               name="generic_name"
                               class="form-control"
                               value="{{ old('generic_name') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Strength</label>
                        <input type="text"
                               name="strength"
                               class="form-control"
                               value="{{ old('strength') }}"
                               placeholder="500 mg">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Unit</label>
                        <input type="text"
                               name="unit"
                               class="form-control"
                               value="{{ old('unit') }}"
                               placeholder="Tablet">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Purchase Price</label>
                        <input type="number"
                               step="0.01"
                               name="purchase_price"
                               class="form-control"
                               value="{{ old('purchase_price',0) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Selling Price</label>
                        <input type="number"
                               step="0.01"
                               name="selling_price"
                               class="form-control"
                               value="{{ old('selling_price',0) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Opening Stock</label>
                        <input type="number"
                               name="stock_qty"
                               class="form-control"
                               value="{{ old('stock_qty',0) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Reorder Level</label>
                        <input type="number"
                               name="reorder_level"
                               class="form-control"
                               value="{{ old('reorder_level',10) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-success">
                Save Medicine
            </button>

            <a href="{{ route('medicines.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </form>

</div>

@stop