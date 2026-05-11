<?php

namespace App\Livewire;

use App\Models\Short;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;

class DeleteShort extends Component
{
    public Short $short;
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
        $this->short->delete();
        return redirect()->route('shorts.index')->with('message', 'Short eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.delete-short');
    }
}
