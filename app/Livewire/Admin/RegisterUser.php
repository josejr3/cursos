<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;


class RegisterUser extends Component
{
    public $nombre = '';
    public $apellidos = '';
    public $email = '';
    public $descripcion = '';

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'descripcion' => 'nullable|string|max:1000',
    ];
    public function mount()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }

    public function save()
    {
        $this->validate();

        User::create([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'descripcion' => $this->descripcion,
            'password' => Hash::make(Str::random(12)), // Contraseña aleatoria oculta
            'is_admin' => false,
        ]);

        $this->reset();
        session()->flash('status', 'Usuario registrado con éxito.');
    }

    public function render()
    {
        return view('livewire.admin.register-user')
            ->layout('layouts.app');
    }
}