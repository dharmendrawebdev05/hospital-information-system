@extends('adminlte::page')

@section('title','OPD Visits')

@section('content')

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h3 class="card-title">OPD Visits</h3>
</div>

<div class="card-body">

<table class="table table-bordered table-striped"
id="opdTable">

<thead>

<tr>
<th>#</th>
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

@push('js')

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

@endpush