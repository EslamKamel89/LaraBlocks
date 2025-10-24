<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Http\Resources\UserSafeResource;
use Modules\Users\Models\User;

class UserController extends Controller {
    public function show(User $user) {
        return UserSafeResource::make($user);
    }
}
