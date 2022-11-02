<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ItemOnCart;
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
        $this->cartService = new CartService($this->cartRepository, new ServiceRepository(), new PackageRepository(), new ItemOnCart());
    }
    public function index()
    {

        $session = session();
        $carts = $session->cart;

        return view("user/cart/index", compact("carts"));
    }
    public function create()
    {
        $session = session();
        $cart_id = $session->cart_id;
        $itemRepository = new ItemRepository();
        $items = $itemRepository->getItems();
        $title = "Tambah Pakaian";
        $cart = $this->cartRepository->getDetailCart($cart_id, array("serviceName", "packageName"))[0];
        return view("user/cart/insert_item", compact("cart", "items", "title", "cart_id"));
    }
    public function store()
    {

        $rules = array(
            "service_name" => ["required"],
            "package" => ["required"],
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


        $result = $this->cartService->insertToCart($account_id, $service, $package);

        if (!$result) {
            return redirect()->to(base_url("/user/new-order"))->with("error", "terjadi kesalahan");
        }

        return redirect()->to(base_url("/user/select-item"))->with("success", "berhasil ditambahkan ke keranjang");
    }
    public function storeItem()
    {
        $cart_id = $this->request->getVar("cart_id");
        $clothes = $this->request->getVar("clothes");
        $quantity = (int)$this->request->getVar("quantity");
        $description = $this->request->getVar("description");

        $result = $this->cartService->insertItemOnCart($cart_id, $clothes, $quantity, $description);

        if (!$result) {
            return redirect()->to(base_url("/user/select-item"))->with("error", "gagal ditambahkan ke keranjang");
        }

        return redirect()->to(base_url("/user/select-item"));
    }

    public function updateCart()
    {
        $itemOnCartID = $this->request->getVar("item-id");
        $action = $this->request->getVar("action");

        if ($action == "delete") {
            return $this->deleteItemOnCart($itemOnCartID, $action);
        }

        $result = $this->cartService->updateCart($itemOnCartID, $action);

        if (!$result) {
            return redirect()->to(base_url("/user/cart"))->with("error", "gagal update keranjang");
        }

        return redirect()->to(base_url("/user/cart"))->with("success", "berhasil update keranjang");
    }
    private function deleteItemOnCart(string $itemOnCart_id, string $action)
    {
        $result = $this->cartService->updateCart($itemOnCart_id, $action);
        if (!$result) {
            return redirect()->to(base_url("/user/cart"))->with("error", "gagal menghapus keranjang");
        }

        return redirect()->to(base_url("/user/cart"))->with("success", "berhasil menghapus keranjang");
    }
}
