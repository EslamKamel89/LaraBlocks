<?php

namespace Modules\Tasks\Livewire\Components;

use Livewire\Component;

class Filters extends Component {
    public ?string $search  = null;
    public ?string $isDone  = null; // '1' , '0' , null

    public function updated($name) {
        $this->dispatch('filters-updated', $this->search, $this->isDone);
    }
    public function render() {
        return view('tasks::livewire.tasks.components.filters');
    }
}
