@extends('adminlte::page')

@section('title','OPD Visits')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3 class="card-title">OPD Visits</h3>
</div>

<div class="card-body">

{{-- Validation Errors --}}
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>

<ul class="mb-0">
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

</div>
@endif

{{-- Success Message --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{ session('success') }}
</div>
@endif




<table class="table table-bordered table-striped"
id="opdTable">

<thead>

<tr>
<th>Token</th>
<th>Visit No</th>
<th>Patient</th>
<th>Doctor</th>
<th>Status</th>
<th>Action</th>
</tr>



</thead>

</table>

</div>

</div>


@stop

@section('js')

<script>

$(function () {

var table = $('#opdTable').DataTable({

processing: true,
serverSide: true,
responsive: true,
orderCellsTop: true,
fixedHeader: true,

ajax: "{{ route('opd.index') }}",

columns: [

{
data: 'DT_RowIndex',
searchable: false,
orderable: false
},


{
data: 'visit_no',
name: 'visit_no'
},

{
data: 'patient_name',
name: 'patient_name'
},

{
data: 'doctor_name',
name: 'doctor_name'
},

{
data: 'status_badge',
name: 'status'
},

{
data: 'action',
searchable: false,
orderable: false
}
]
});


});

</script>

@stop