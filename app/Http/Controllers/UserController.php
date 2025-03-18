<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $query = User::query();

            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('id', 'like', "%{$search}%")
                      ->orWhere('created_at', 'like', "%{$search}%");
                });
            }

            if ($request->filled('role')) {
                $query->where('isAdmin', $request->role);
            }

            $allowedFields = ['id', 'name', 'email', 'isAdmin', 'created_at'];
            $orderBy = in_array($request->input('order_by'), $allowedFields) ? $request->input('order_by') : 'id';
            $orderDir = $request->input('order_dir') === 'asc' ? 'asc' : 'desc';

            $query->orderBy($orderBy, $orderDir);

            $users = $query->paginate(10)->appends($request->query());

            return view('users.index', compact('users', 'orderBy', 'orderDir'));
    }

    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('users.show', [
            'user'      => $user,
            'editMode'  => $request->query('editMode', false)
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
            'isAdmin'   => 'boolean'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'  => 'nullable|string|min:6|confirmed',
            'isAdmin'   => 'boolean'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.show', $id)->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Você não pode excluir sua própria conta.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }

}
