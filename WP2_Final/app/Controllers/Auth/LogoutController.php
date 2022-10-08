<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url("auth/login"))->with("success", "berhasil logout");
    }
}
