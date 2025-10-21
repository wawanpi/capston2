<?php

namespace App\Http\Controllers\Admin; // Pastikan namespace benar

use App\Http\Controllers\Controller; // <-- Jangan lupa use Controller
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role; // <-- Impor Role
use Illuminate\Support\Arr; // <-- Impor Arr untuk helper array

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10); // Ambil user beserta rolenya, batasi 10 per halaman
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all(); // Ambil semua nama role
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => ['required', 'string'], // Pastikan role dipilih
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Tetapkan role yang dipilih
        $user->assignRole($request->input('roles'));

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Menampilkan detail user (opsional, bisa dilewati jika tidak perlu).
     */
    public function show(User $user)
    {
        // Biasanya tidak terlalu perlu untuk manajemen admin, tapi bisa dibuat jika ingin
        // return view('admin.users.show', compact('user'));
        return redirect()->route('admin.users.index');
    }

    /**
     * Menampilkan form untuk mengedit user.
     */
    public function edit(User $user) // Laravel otomatis mencari user berdasarkan ID di URL
    {
        $roles = Role::pluck('name', 'name')->all(); // Ambil semua nama role
        $userRole = $user->roles->pluck('name', 'name')->first(); // Ambil role user saat ini (asumsi 1 role)

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Memperbarui data user di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$user->id], // Abaikan email user saat ini
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Password opsional
            'roles' => ['required', 'string'], // Pastikan role dipilih
        ]);

        // Siapkan data input, hapus password jika kosong
        $input = $request->except(['password', 'password_confirmation']);
        if(empty($input['password'])){
            $input = Arr::except($input, array('password'));
        } else {
            $input['password'] = Hash::make($input['password']); // Hash password baru jika diisi
        }

        // Update data user
        $user->update($input);

        // Hapus role lama dan tetapkan role baru (cara aman)
        $user->syncRoles($request->input('roles'));

        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database.
     */
    public function destroy(User $user)
    {
        // Tambahkan validasi agar admin tidak bisa menghapus dirinya sendiri (opsional)
        if (auth()->user()->id == $user->id) {
             return redirect()->route('admin.users.index')
                         ->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}