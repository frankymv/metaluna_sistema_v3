<?php

namespace App\Livewire;

use Livewire\Component;
use Exception;


class EstadoController extends Component
{
    use LivewireAlert;
    use WithPagination;
    public function render()
    {
        return view('livewire.pages.estado-controller');
    }
}
