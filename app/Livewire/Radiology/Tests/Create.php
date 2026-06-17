<?php

namespace App\Livewire\Radiology\Tests;

use App\Models\RadiologyTest;
use Livewire\Component;

class Create extends Component
{
public $test_code;
public $test_name;
public $modality = 'X-Ray';
public $price;
public $is_active = 1;

protected $rules = [
'test_code' => 'required|unique:radiology_tests,test_code',
'test_name' => 'required',
'modality' => 'required',
'price' => 'nullable|numeric',
'is_active' => 'required'
];

public function save()
{
$this->validate();

RadiologyTest::create([
'test_code' => $this->test_code,
'test_name' => $this->test_name,
'modality' => $this->modality,
'price' => $this->price,
'is_active' => $this->is_active,
]);

$this->dispatch('tests-saved');

/*return redirect()
->route('radiology-tests.index');*/
}

public function render()
{
return view(
'livewire.radiology.tests.create'
);
}
}