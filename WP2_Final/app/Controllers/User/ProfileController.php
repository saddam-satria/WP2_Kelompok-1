<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        return view("user/profile");
    }
}
