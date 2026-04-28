<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Course;
use App\Models\Short;
use Illuminate\Support\Facades\Hash;

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
public $status; // Variable persistente para errores de Excel

public $statusMsg;
public function setTab($tabName)
{
    $this->tab = $tabName;
}

public function cargarUsuariosJson($datos)
{
    $this->statusMsg = null; // Limpiamos al empezar nuevo intento

    if (empty($datos)) {
        $this->statusMsg = 'Error: El archivo está vacío.';
        return;
    }

    $limpiar = function($texto) {
        $texto = mb_strtolower(trim($texto), 'UTF-8');
        $acentos = ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n'];
        $texto = strtr($texto, $acentos);
        return preg_replace('/[^a-z0-9]/', '', $texto);
    };

    $encabezadosOriginales = array_keys($datos[0]);
    $mapaColumnas = [];
    foreach ($encabezadosOriginales as $columna) {
        $mapaColumnas[$limpiar($columna)] = $columna;
    }

    $llaveNombre = $mapaColumnas['nombre'] ?? null;
    $llaveApellidos = $mapaColumnas['apellidos'] ?? null;
    $llaveEmail = $mapaColumnas['correoelectronico'] ?? $mapaColumnas['email'] ?? null;
    $llaveDesc = $mapaColumnas['descripcion'] ?? null;

    if (!$llaveNombre) { $this->statusMsg = 'Error: Falta la columna Nombre.'; return; }
    if (!$llaveApellidos) { $this->statusMsg = 'Error: Falta la columna Apellidos.'; return; }
    if (!$llaveEmail) { $this->statusMsg = 'Error: Falta la columna Correo Electrónico.'; return; }
    if (!$llaveDesc) { $this->statusMsg = 'Error: Falta la columna Descripción.'; return; }

    $contadorRegistrados = 0;
    foreach ($datos as $fila) {
        $nombre = trim($fila[$llaveNombre] ?? '');
        $apellidos = trim($fila[$llaveApellidos] ?? '');
        $email = trim($fila[$llaveEmail] ?? '');
        $descripcion = trim($fila[$llaveDesc] ?? '');

        if (empty($nombre) || empty($apellidos) || empty($email) || empty($descripcion)) {
            continue; 
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (!\App\Models\User::where('email', $email)->exists()) {
                \App\Models\User::create([
                    'name' => $nombre,
                    'last_name' => $apellidos,
                    'email' => $email,
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'descripcion' => $descripcion,
                ]);
                $contadorRegistrados++;
            }
        }
    }

    if ($contadorRegistrados === 0) {
        $this->statusMsg = 'Error: No se pudo registrar a nadie. Verifique celdas vacías.';
    } else {
        $this->statusMsg = "Importación exitosa: Se registraron $contadorRegistrados usuarios.";
    }
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
            'descripcion' => $this->descripcion_usuario,
        ]);

        session()->flash('status', 'Usuario registrado exitosamente.');
        
        $this->reset(['nombre', 'apellidos', 'email', 'descripcion_usuario']);
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
        
        $this->reset(['titulo_short', 'url_short']);
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
            'description' => $this->descripcion_curso,
        ]);

        session()->flash('status', 'Curso registrado exitosamente.');
        
        $this->reset(['tcitulo', 'url_video', 'estado', 'descripcion_curso']);
    }

    public function render()
    {
        return view('livewire.admin.admin-panel', [
            'shorts' => Short::query()->latest()->get(),
        ]);
    }
}