<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function create()
    {

        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        $user = User::create($request->only('email', 'name', 'password'));
        $roles = $request['roles'];

        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        return redirect()->route('users.index')
            ->with('flash_message',
                'User successfully added.');
    }
    public function show($id)
    {
        return redirect('users');
    }

    public function edit($id)
    {

        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('users.edit', compact('user', 'roles')); //pass user and roles data to view

    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); //Get role specified by id

        $input = $request->only(['name', 'email', 'password']);
        $roles = $request['roles'];

        if (isset($roles)) {
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }
        return redirect()->route('users.index')
            ->with('flash_message',
                'User successfully edited.');

    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => "User deleted successfully"], 204);
    }

    public function disable($id){
        $user = User::find($id);
        $user->is_active =! $user->is_active;

        if ($user->save()){
            return redirect(route('users.index'))->with('success', 'User disabled');
        }else{
            return redirect(route('users.index'))->with('info', "User enabled");
        }

    }

}
