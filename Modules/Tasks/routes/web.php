<?php

use Modules\Tasks\Livewire\Index;

Route::middleware(['web'])
    ->group(function () {
        Route::get('/tasks', Index::class)->name('tasks.index');
    });
