@extends('print.layouts.master')

@section('content')

<h3>🧪 Lab Investigation</h3>

<table>
<thead>
<tr>
<th>Test</th>
<th>Instruction</th>
<th>Status</th>
</tr>
</thead>

<tbody>
@foreach($visit->consultation->labOrders as $lab)
<tr>
<td>{{ $lab->test->test_name }}</td>
<td>{{ $lab->instruction }}</td>
<td>{{ $lab->status }}</td>
</tr>
@endforeach
</tbody>
</table>

@endsection