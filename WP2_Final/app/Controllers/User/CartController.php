<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Repositories\CartRepository;
use App\Repositories\ItemRepository;
use App\Repositories\PackageRepository;
use App\Repositories\ServiceRepository;
use App\Services\CartService;

class CartController extends BaseController
{
    private $cartService;
    private $cartRepository;
    public function __construct()
    {
        $this->cartRepository = new CartRepository();
        $this->cartService = new CartService($this->cartRepository, new ServiceRepository(), new PackageRepository());
    }
    public function index()
    {
        $session = session();
        $current_user = $session->current_user[0];
        $cart_id = $session->cart_id;

        $carts = $this->cartRepository->getCartByID($cart_id)[0];
        return view("user/cart/index", compact("carts"));
    }
    public function create()
    {
        $session = session();
        $cart_id = $session->cart_id;
        $itemRepository = new ItemRepository();
        $items = $itemRepository->getItems();

        $cart = $this->cartRepository->getDetailCart($cart_id, array("serviceName", "packageName"))[0];
        return view("user/cart/insert_item", compact("cart", "items"));
    }
    public function store()
    {
        $session = session();
        $currentCart = $session->cart_id;

        if (!is_null($currentCart)) {
            return redirect()->to(base_url("/user/select-item"));
        }


        $rules = array(
            "service_name" => ["required"],
            "package" => ["required"],
        );


        if (!$this->validate($rules)) {
            helper("form");
            $validation = $this->validator->getErrors();
            return redirect()->to(base_url("/user/new-order"))->with("validation", $validation);
        }




        $currentUser = $session->current_user[0];
        $account_id = $currentUser->id;
        $service = $this->request->getVar("service_name");
        $package = $this->request->getVar("package");




        $result = $this->cartService->insertToCart($account_id, $service, $package);

        if (!$result) {
            return redirect()->to(base_url("/user/new-order"))->with("error", "terjadi kesalahan");
        }

        $sessionPayload = array(
            "cart_id" => $result,
        );
        $session->set($sessionPayload);

        return redirect()->to(base_url("/user/select-item"))->with("success", "berhasil ditambahkan ke keranjang");
    }
}
