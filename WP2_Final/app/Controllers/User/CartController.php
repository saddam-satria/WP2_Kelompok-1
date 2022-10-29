<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\CartRepository;
use App\Services\CartService;

class CartController extends BaseController
{
    private $cartService;
    private $cartRepository;
    public function __construct()
    {
        $this->cartRepository = new CartRepository();
        $this->cartService = new CartService($this->cartRepository);
    }
    public function index()
    {
        $carts = $this->cartRepository->getCarts();
        return view("user/cart/index", compact("carts"));
    }
    public function store()
    {

        $rules = array(
            "service_name" => ["required"],
            "package" => ["required"],
            "clothes" => ["required"],
            "quantity" => ["required"],
            "description" => ["required"],
        );


        if (!$this->validate($rules)) {
            helper("form");
            $validation = $this->validator->getErrors();

            return redirect()->to(base_url("/user/new-order"))->with("validation", $validation);
        }



        $session = session();
        $currentUser = $session->current_user[0];
        $account_id = $currentUser->id;
        $service = $this->request->getVar("service_name");
        $package = $this->request->getVar("package");
        $item = $this->request->getVar("clothes");
        $quantity = (int)$this->request->getVar("quantity");
        $description = $this->request->getVar("description");



        $result = $this->cartService->insertToCart($account_id, $service, $package, $item, $quantity, $description);

        if (!$result) {
            return redirect()->to(base_url("/user/new-order"))->with("error", "terjadi kesalahan");
        }
        return redirect()->to(base_url("/user/new-order"))->with("success", "berhasil ditambahkan ke keranjang");
    }
}
