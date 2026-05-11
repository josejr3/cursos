<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;

class DeleteCourse extends Component
{
    public Course $course;
    public bool $confirmingDelete = false;

    public function confirmDelete()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }
        $this->course->delete();
        return redirect()->route('dashboard')->with('message', 'Curso eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.delete-course');
    }
}
