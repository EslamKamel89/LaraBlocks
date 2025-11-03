<?php

namespace Modules\Tasks\Livewire\Components;


use Livewire\Attributes\Locked;
use Livewire\Component;
use Modules\Tasks\Models\Task;

class Row extends Component {
    #[Locked]
    public int $taskId;
    public string $title;
    public ?string $description  = null;
    public bool $isDone = false;
    public ?string $updatedHuman;

    public function render() {
        return view('tasks::livewire.tasks.components.row');
    }
}
