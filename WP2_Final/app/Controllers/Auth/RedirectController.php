<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class RedirectController extends BaseController
{
    public function index()
    {
        return redirect()->to(base_url("auth/login"));
    }
}
