<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
public function index()
{
$permissions = Permission::latest()->get();

return view('permissions.index', compact('permissions'));
}

public function create()
{
return view('permissions.create');
}

public function store(Request $request)
{
$request->validate([
'name' => 'required|unique:permissions,name'
]);

Permission::create([
'name' => $request->name
]);

return redirect()
->route('permissions.index')
->with('success', 'Permission Created Successfully');
}
}