@extends('adminlte::page')

@section('title', 'Schedule Sessions')

@section('content')

<div class="card card-outline card-primary mt-3">

<div class="card-header">

<h3>
Sessions -
{{ $doctorSchedule->doctor->doctor_name }}
({{ $doctorSchedule->day_name }})
</h3>

<a href="{{ route('doctor-schedules.sessions.create',
$doctorSchedule->id) }}"
class="btn btn-primary float-right">

<i class="fas fa-plus"></i>
Add Session

</a>

</div>

<div class="card-body">

<table class="table table-bordered"
id="sessionTable">

<thead>

<tr>

<th>#</th>
<th>Session</th>
<th>Start</th>
<th>End</th>
<th>Slot Duration</th>
<th>Max Patients</th>
<th>Status</th>
<th width="150">
Action
</th>

</tr>

</thead>

</table>

</div>

</div>

@stop

@section('js')

<script>

$('#sessionTable').DataTable({

processing:true,
serverSide:true,

ajax:
"{{ route('doctor-schedules.sessions.index',$doctorSchedule->id) }}",

columns:[

{
data:'DT_RowIndex',
name:'DT_RowIndex',
searchable:false,
orderable:false
},

{
data:'session_name',
name:'session_name'
},

{
data:'start_time',
name:'start_time'
},

{
data:'end_time',
name:'end_time'
},

{
data:'slot_duration',
name:'slot_duration'
},

{
data:'max_patients',
name:'max_patients'
},

{
data:'is_active',
name:'is_active'
},

{
data:'action',
name:'action',
searchable:false,
orderable:false
}

]

});

</script>

@stop