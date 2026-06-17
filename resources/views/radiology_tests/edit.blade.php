@extends('adminlte::page')

@section('title','Edit Radiology Test')

@section('content')

<livewire:radiology.tests.edit
    :test="$radiology_test" />

@stop