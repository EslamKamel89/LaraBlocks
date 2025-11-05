<?php

namespace Modules\Tasks\Livewire;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Modules\Tasks\Models\Task;

class TasksEdit extends Component {
    public Task $task;
    public string $title = '';
    public ?string $description = null;
    public bool $is_done = false;
    public function mount() {
        Gate::authorize('update', $this->task);
        $this->title = $this->task->title;
        $this->description = $this->task->description;
        $this->is_done = (bool)$this->task->is_done;
    }
    protected function rules() {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_done' => ['boolean'],
        ];
    }
    public function submit() {
        Gate::authorize('update', $this->task);
        $data = $this->validate();
        $this->task->update($data);
        session()->flash('status', 'Task updated successfully');
        $this->redirectRoute('tasks.index', navigate: true);
    }
    public function render() {
        Gate::authorize('update', $this->task);
        return view('tasks::livewire.tasks.tasks-edit', [
            'title' => 'Edit Task',
        ]);
    }
}
