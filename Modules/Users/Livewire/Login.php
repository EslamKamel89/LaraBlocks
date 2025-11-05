<?php

namespace Modules\Users\Livewire;

use Livewire\Component;
use Modules\Users\Http\Services\AuthService;

class Login extends Component {
    public string $email  = '';
    public string $password  = '';
    public bool $remember  = false;
    protected function rules() {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ];
    }
    public function submit(AuthService $auth) {
        $this->validate();
        if ($auth->login($this->email, $this->password, $this->remember)) {
            $this->redirect(route('tasks.index'));
        }
        session()->flash('serverErrors', ['The provided credentials do not match our records.']);
        return redirect()->back();
    }
    public function render() {
        return view('users::livewire.users.login', ['title' => 'Login']);
    }
}
