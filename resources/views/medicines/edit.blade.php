@extends('adminlte::page')

@section('title', 'Edit Medicine')

@section('content')

<div class="card mt-3  card-outline card-primary">

    <div class="card-header">
        <h3 class="card-title">
            Edit Medicine
        </h3>
    </div>

    <form method="POST"
          action="{{ route('medicines.update',$medicine->id) }}">

        @csrf
        @method('PUT')

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
                        <label>Medicine Name</label>
                        <input type="text"
                               name="medicine_name"
                               class="form-control"
                               value="{{ old('medicine_name',$medicine->medicine_name) }}"
                               required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Generic Name</label>
                        <input type="text"
                               name="generic_name"
                               class="form-control"
                               value="{{ old('generic_name',$medicine->generic_name) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Strength</label>
                        <input type="text"
                               name="strength"
                               class="form-control"
                               value="{{ old('strength',$medicine->strength) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Unit</label>
                        <input type="text"
                               name="unit"
                               class="form-control"
                               value="{{ old('unit',$medicine->unit) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Purchase Price</label>
                        <input type="number"
                               step="0.01"
                               name="purchase_price"
                               class="form-control"
                               value="{{ old('purchase_price',$medicine->purchase_price) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Selling Price</label>
                        <input type="number"
                               step="0.01"
                               name="selling_price"
                               class="form-control"
                               value="{{ old('selling_price',$medicine->selling_price) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Stock Qty</label>
                        <input type="number"
                               name="stock_qty"
                               class="form-control"
                               value="{{ old('stock_qty',$medicine->stock_qty) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Reorder Level</label>
                        <input type="number"
                               name="reorder_level"
                               class="form-control"
                               value="{{ old('reorder_level',$medicine->reorder_level) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="1"
                                {{ $medicine->status == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ $medicine->status == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>
                </div>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-primary">
                Update Medicine
            </button>

            <a href="{{ route('medicines.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </form>

</div>

@stop