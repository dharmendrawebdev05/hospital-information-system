<?php

namespace App\Livewire\Radiology\Tests;

use Livewire\Component;
use App\Models\RadiologyTest;

class Edit extends Component
{
public RadiologyTest $test;

public $test_code;
public $test_name;
public $modality;
public $price;
public $is_active;

public function mount(RadiologyTest $test)
{
$this->test = $test;

$this->test_code = $test->test_code;
$this->test_name = $test->test_name;
$this->modality = $test->modality;
$this->price = $test->price;
$this->is_active = $test->is_active;
}

protected function rules()
{
return [
'test_code' => 'required|unique:radiology_tests,test_code,' . $this->test->id,
'test_name' => 'required',
'modality' => 'required',
'price' => 'nullable|numeric',
'is_active' => 'required',
];
}

public function update()
{
$this->validate();

$this->test->update([
'test_code' => $this->test_code,
'test_name' => $this->test_name,
'modality' => $this->modality,
'price' => $this->price,
'is_active' => $this->is_active,
]);

$this->dispatch('tests-updated');

/*return redirect()
->route('radiology-tests.index');*/
}

public function render()
{
return view(
'livewire.radiology.tests.edit'
);
}
}