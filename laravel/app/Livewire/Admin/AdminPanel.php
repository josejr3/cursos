<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use App\Models\Short;

#[Layout('layouts.app')]
class AdminPanel extends Component
{
    public $tab = 'usuario';

    public $nombre;
    public $apellidos;
    public $email;
    public $descripcion_usuario;

    public $titulo;
    public $url_video;
    public $estado = 'activo';
    public $descripcion_curso;

    public $titulo_short;
    public $url_short;

    public function setTab($tabName)
    {
        $this->tab = $tabName;
        $this->resetValidation();
    }

    public function saveUsuario()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'descripcion_usuario' => 'nullable|string',
        ]);

        User::create([
            'name' => $this->nombre,
            'last_name' => $this->apellidos,
            'email' => $this->email,
            'password' => Hash::make('password'),
            'description' => $this->descripcion_usuario,
        ]);

        session()->flash('status', 'Usuario registrado exitosamente.');
        
        $this->reset([
            'nombre', 
            'apellidos', 
            'email', 
            'descripcion_usuario'
        ]);
    }

    public function saveShort()
    {
        $this->validate([
            'titulo_short' => 'required|string|max:255',
            'url_short' => 'required|url|max:255',
        ]);

        Short::create([
            'titulo' => $this->titulo_short,
            'url' => $this->url_short,
        ]);

        session()->flash('status', 'Short registrado exitosamente.');
        
        $this->reset([
            'titulo_short', 
            'url_short'
        ]);
    }

    public function deleteShort(int $shortId)
    {
        Short::query()->whereKey($shortId)->delete();

        session()->flash('status', 'Short eliminado exitosamente.');
    }

    public function saveCurso()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'url_video' => 'required|url|max:255',
            'estado' => 'required|in:activo,inactivo',
            'descripcion_curso' => 'nullable|string',
        ]);

        Course::create([
            'titulo' => $this->titulo,
            'url_video' => $this->url_video,
            'estado' => $this->estado,
            'descripcion' => $this->descripcion_curso,
        ]);

        session()->flash('status', 'Curso registrado exitosamente.');
        
        $this->reset([
            'titulo', 
            'url_video', 
            'estado', 
            'descripcion_curso'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.admin-panel', [
            'shorts' => Short::query()->latest()->get(),
        ]);
    }
}