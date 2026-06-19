@extends('adminlte::page')

@section('title','Follow-up Patients')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">
<h3 class="card-title">
Follow-up Patients
</h3>
</div>

<div class="card-body">

<table id="followupTable"
class="table table-bordered table-striped">

<thead>
<tr>
<th>#</th>
<th>Patient</th>
<th>Doctor</th>
<th>Follow-up Date</th>
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

$('#followupTable').DataTable({

processing:true,
serverSide:true,

ajax:"{{ route('followups.index') }}",

columns:[

{
data:'DT_RowIndex',
searchable:false,
orderable:false
},

{
data:'patient_name',
name:'patient_name'
},

{
data:'doctor_name',
name:'doctor_name'
},

{
data:'followup_date',
name:'followup_date'
},

{
data:'status',
name:'status'
},

{
data:'action',
searchable:false,
orderable:false
}
]
});

</script>

@endpush