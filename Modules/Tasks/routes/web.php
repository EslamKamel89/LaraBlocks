<?php

use Modules\Tasks\Livewire\Index;
use Modules\Tasks\Livewire\TasksCreate;
use Modules\Tasks\Livewire\TasksEdit;

Route::middleware(['web'])
    ->group(function () {
        Route::get('/tasks', Index::class)->name('tasks.index');
        Route::middleware(['auth'])->group(function () {
            Route::get('/tasks/create', TasksCreate::class)->name('tasks.create');
            Route::get('/tasks/{task}/edit', TasksEdit::class)->name('tasks.edit');
        });
    });
