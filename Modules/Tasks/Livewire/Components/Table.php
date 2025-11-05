<?php

namespace Modules\Tasks\Livewire\Components;


use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Tasks\Models\Task;

class Table extends Component {
    use WithPagination;
    public ?string $search = null;
    public ?string $isDone = null; // '0' , '1' , null
    #[On('filters-updated')]
    public function syncFilters(?string $search, ?string $isDone) {
        $this->search = $search;
        $this->isDone = $isDone;
        $this->resetPage();
    }

    public function render() {
        $query = Task::query();
        if ($this->search) {
            $query->search($this->search);
        }
        if ($this->isDone === '1' || $this->isDone === '0') {
            $flag = (bool)$this->isDone;
            $query->done($flag);
        }
        $tasks = $query->with(['user'])->latest()->paginate(10);
        return view('tasks::livewire.tasks.components.table', ['tasks' => $tasks]);
    }
}
