<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function accountAdminIndex(Request $request)
    {
        $search = $request->input('search');

    $users = User::where('role', 'admin')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->get();
        return view('admin.AccountResource.Pages.viewAccount', compact('users'));
    }

    public function accountAdminCreate()
    {
        return view('admin.AccountResource.Pages.createAccount');
    }

    public function accountAdminStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()->route('dashboard.admin.akun.view')->with('success', 'Admin account created successfully.');
    }

    public function accountAdminEdit($id)
    {
         $user = User::findOrFail($id);
        return view('admin.AccountResource.Pages.editAccount', compact('user'));
    }

    public function accountAdminUpdate(Request $request, $id)
    {
         $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return redirect()->route('dashboard.admin.account.index')->with('success', 'Admin account updated successfully.');
    }

    public function accountAdminDelete($id)
    {
         $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard.admin.account.index')->with('success', 'Admin account deleted successfully.');
    }

}
