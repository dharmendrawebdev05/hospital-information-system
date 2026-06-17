@extends('adminlte::page')

@section('title','Medicines')

@section('content')

<div class="card card-outline card-primary">

<div class="card-header">

<div class="d-flex justify-content-between">

<h3 class="card-title">
Medicines Master
</h3>

<a href="{{ route('medicines.create') }}"
class="btn btn-primary btn-sm">

Add Medicine

</a>

</div>

</div>

<div class="card-body">

<table class="table table-bordered table-striped"
id="medicineTable">

<thead>

<tr>
<th>#</th>
<th>Medicine</th>
<th>Strength</th>
<th>Stock</th>
<th>Stock Status</th>
<th>MRP</th>
<th>Action</th>
</tr>

</thead>

</table>

</div>

</div>

@stop

@push('js')

<script>

$(function () {

$('#medicineTable').DataTable({

processing: true,
serverSide: true,
responsive: true,

ajax: "{{ route('medicines.index') }}",

columns: [

{
data: 'DT_RowIndex',
name: 'DT_RowIndex',
orderable: false,
searchable: false
},

{
data: 'medicine_name',
name: 'medicine_name'
},

{
data: 'strength',
name: 'strength'
},

{
data: 'stock_qty',
name: 'stock_qty'
},

{
data: 'stock_status',
name: 'stock_qty',
orderable: false,
searchable: false
},

{
data: 'selling_price',
name: 'selling_price'
},

{
data: 'action',
orderable: false,
searchable: false
}

]

});

});

</script>

@endpush