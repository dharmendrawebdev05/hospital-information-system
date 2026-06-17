<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
class UserController extends Controller
{



public function index(Request $request)
{
if ($request->ajax()) {

$data = User::with('roles')
    ->whereDoesntHave('roles', function ($q) {
        $q->where('name', 'Super Admin');
    })
    ->select('users.*');

return DataTables::of($data)
->addIndexColumn()

->addColumn('role', function ($row) {
return $row->getRoleNames()->implode(', ') ?: '-';
})

->addColumn('status', function ($row) {

if (isset($row->status) && $row->status == 1) {
return '<span class="badge badge-success">Active</span>';
}

return '<span class="badge badge-danger">Inactive</span>';
})

->addColumn('action', function ($row) {

return '
<a href="'.route('users.show',$row->id).'" class="btn btn-info btn-sm">View</a>
<a href="'.route('users.edit',$row->id).'" class="btn btn-warning btn-sm">Edit</a>

<form method="POST" action="'.route('users.destroy',$row->id).'" style="display:inline">
'.csrf_field().'
'.method_field("DELETE").'
<button class="btn btn-danger btn-sm" onclick="return confirm(\'Delete User?\')">
Delete
</button>
</form>';
})

->rawColumns(['status','action'])
->make(true);
}

$roles = Role::all();

return view('users.index', compact('roles'));

}



public function create()
{
$roles = Role::all();

return view('users.create', compact('roles'));
}

public function store(Request $request)
{
$request->validate([
'name' => 'required',
'email' => 'required|unique:users',
'password' => 'required',
'role' => 'required'
]);

$user = User::create([
'name' => $request->name,
'email' => $request->email,
'password' => Hash::make($request->password),
]);

$user->assignRole($request->role);

return redirect()->route('users.index');
}


public function edit($id)
{
    $user = User::findOrFail($id);
    $roles = Role::all();

    return view('users.edit', compact('user', 'roles'));
}


public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // roles update
    $user->syncRoles($request->roles ?? []);

    return redirect()->route('users.index')
        ->with('success', 'User updated successfully');
}





}