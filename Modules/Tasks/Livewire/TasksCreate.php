<?php

namespace Modules\Tasks\Livewire;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\AuthorizesRequests;
use Livewire\Component;
use Modules\Tasks\Models\Task;

class TasksCreate extends Component {
    public string $title = '';
    public ?string $description = null;
    public bool $is_done = false;
    protected function rules(): array {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_done' => ['boolean'],
        ];
    }
    public function submit(bool $createAnother = false) {
        Gate::authorize('create', Task::class);
        $data = $this->validate();
        auth()->user()->tasks()->create($data);
        session()->flash('status', 'task created');
        if ($createAnother) {
            $this->redirectRoute('tasks.create', navigate: true);
        } else {
            $this->redirectRoute('tasks.index', navigate: true);
        }
    }
    public function render() {
        Gate::authorize('create', Task::class);
        return view('tasks::livewire.tasks.tasks-create', [
            'title' => 'Create Task',
        ]);
    }
}
