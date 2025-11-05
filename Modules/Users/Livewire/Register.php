<?php

namespace Modules\Users\Livewire;

use Livewire\Component;
use Modules\Users\Http\Services\AuthService;

class Register extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    protected function rules() {
        return [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:6', 'confirmed'],

        ];
    }
    public function submit(AuthService $auth) {
        $data  = $this->validate();
        $auth->register($data);
        return $this->redirect(route('tasks.index'),);
    }
    public function render() {
        return view('users::livewire.users.register');
    }
}
