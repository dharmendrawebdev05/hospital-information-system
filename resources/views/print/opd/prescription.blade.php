@extends('print.layouts.master')

@section('content')

<h3>💊 OPD Prescription</h3>

<table>
<thead>
<tr>
<th>Medicine</th>
<th>Dosage</th>
<th>Frequency</th>
<th>Days</th>
</tr>
</thead>

<tbody>
@foreach($visit->consultation->prescriptions as $p)
<tr>
<td>{{ $p->medicine->medicine_name }}</td>
<td>{{ $p->dosage }}</td>
<td>{{ $p->frequency }}</td>
<td>{{ $p->duration }}</td>
</tr>
@endforeach
</tbody>
</table>

@endsection