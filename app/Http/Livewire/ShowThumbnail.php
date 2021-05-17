<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowThumbnail extends Component
{
	public $resource;

    public function render()
    {
        return view('livewire.show-thumbnail');
    }
}
