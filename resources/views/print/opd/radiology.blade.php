@extends('print.layouts.master')

@section('content')

<h3>🩻 Radiology Request</h3>

<table>
<thead>
<tr>
<th>Test</th>
<th>Instruction</th>
<th>Priority</th>
</tr>
</thead>

<tbody>
@foreach($visit->consultation->radiologyOrders as $r)
<tr>
<td>{{ $r->test->test_name }}</td>
<td>{{ $r->instruction }}</td>
<td>{{ $r->priority ?? 'Routine' }}</td>
</tr>
@endforeach
</tbody>
</table>

@endsection