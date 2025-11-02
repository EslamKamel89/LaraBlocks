<?php

namespace Modules\Tasks\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Tasks\Models\Task;

class Index extends Component {
    use WithPagination;
    #[Url]
    public ?string $search = null;
    #[Url]
    public ?string $isDone = null;

    public function render() {
        $query = Task::query();
        if ($this->search) {
            $query->search($this->search);
        }
        if ($this->isDone === '1' || $this->isDone === '0') {
            $flag = (bool)$this->isDone;
            $query->done($flag);
        }
        $tasks = $query->paginate(10);
        info('', ['tasks' => $tasks]);
        return view('tasks::livewire.tasks.index', ['tasks' => $tasks, 'title' => 'Tasks']);
    }
}
