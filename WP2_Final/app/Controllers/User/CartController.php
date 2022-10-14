<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class CartController extends BaseController
{
    public function index()
    {
        return view("user/cart/index");
    }
}
