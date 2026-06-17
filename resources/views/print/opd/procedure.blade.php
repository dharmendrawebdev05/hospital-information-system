@extends('print.layouts.master')

@section('content')

<h3>🧑‍⚕️ Procedure Request</h3>

<table>
<thead>
<tr>
<th>Procedure</th>
<th>Remarks</th>
<th>Status</th>
</tr>
</thead>

<tbody>

@forelse($visit->consultation->procedureOrders ?? [] as $p)

<tr>
<td>{{ $p->procedure->procedure_name ?? '-' }}</td>
<td>{{ $p->remarks ?? '-' }}</td>
<td>
<span style="font-weight:bold;">
{{ $p->status ?? 'Pending' }}
</span>
</td>
</tr>

@empty

<tr>
<td colspan="3" style="text-align:center;">
No Procedure Ordered
</td>
</tr>

@endforelse

</tbody>
</table>

@endsection