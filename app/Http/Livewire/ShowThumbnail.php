<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowThumbnail extends Component
{
    public $resource;
    public $name;

    public function setName()
    {
        $this->resource->name = $this->name;
        $this->resource->save();
    }
    
    public function render()
    {
        return view('livewire.show-thumbnail');
    }
}
