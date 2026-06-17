<a href="{{ route('opd.prescription.print', $visit->id) }}" target="_blank" class="btn btn-primary">
    Print Prescription
</a>

<a href="{{ route('opd.lab.print', $visit->id) }}" target="_blank" class="btn btn-warning">
    Print Lab
</a>

<a href="{{ route('opd.radiology.print', $visit->id) }}" target="_blank" class="btn btn-danger">
    Print Radiology
</a>