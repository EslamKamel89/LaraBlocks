<?php

namespace Modules\Tasks\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Tasks\Models\Task;

class Index extends Component {
    #[Url]
    public ?string $search = null;
    #[Url]
    public ?string $isDone = null;


    #[On('filters-updated')]
    public function updateFilters(?string $search = null, ?string $isDone = null) {
        $this->search = $search;
        $this->isDone = $isDone;
    }
    public function render() {
        return view('tasks::livewire.tasks.index', [
            'title' => 'Task',
            'search' => $this->search,
            'isDone' => $this->isDone,
        ]);
    }
}
