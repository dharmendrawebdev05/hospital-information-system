<div class="mt-3">

<form wire:submit.prevent="update">

<div class="card mt-3  card-outline card-primary">

<div class="card-header">
<h4>Edit Radiology Test</h4>
</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">
<label>Test Code</label>

<input type="text"
class="form-control"
wire:model="test_code">

@error('test_code')
<small class="text-danger">
{{ $message }}
</small>
@enderror
</div>

<div class="col-md-4">
<label>Test Name</label>

<input type="text"
class="form-control"
wire:model="test_name">

@error('test_name')
<small class="text-danger">
{{ $message }}
</small>
@enderror
</div>

<div class="col-md-4">
<label>Modality</label>

<select class="form-control"
wire:model="modality">

<option value="X-Ray">X-Ray</option>
<option value="Ultrasound">Ultrasound</option>
<option value="CT Scan">CT Scan</option>
<option value="MRI">MRI</option>
<option value="Mammography">Mammography</option>
<option value="PET CT">PET CT</option>
<option value="DEXA">DEXA</option>

</select>
</div>

<div class="col-md-4 mt-3">
<label>Price</label>

<input type="number"
step="0.01"
class="form-control"
wire:model="price">
</div>

<div class="col-md-4 mt-3">
<label>Status</label>

<select class="form-control"
wire:model="is_active">

<option value="1">
Active
</option>

<option value="0">
Inactive
</option>

</select>
</div>

</div>

</div>

<div class="card-footer">

<button class="btn btn-primary">
Update
</button>

<a href="{{ route('radiology-tests.index') }}"
class="btn btn-secondary">
Cancel
</a>

</div>

</div>

</form>

</div>

@script
<script>

$wire.on('tests-updated', () => {

$(document).Toasts('create', {

class: 'bg-gradient-success',

title: 'Success',

icon: 'fas fa-check-circle',

autohide: true,

delay: 5000,

body: 'Test updated successfully.'

});

});

</script>
@endscript