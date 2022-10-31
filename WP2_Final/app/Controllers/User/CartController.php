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

        $sessionPayload = array(
            "cart_id" => $result,
        );
        $session->set($sessionPayload);

        return redirect()->to(base_url("/user/select-item"))->with("success", "berhasil ditambahkan ke keranjang");
    }
    public function storeItem()
    {
        $cart_id = $this->request->getVar("cart_id");
        $clothes = $this->request->getVar("clothes");
        $quantity = (int)$this->request->getVar("quantity");
        $description = $this->request->getVar("description");

        $itemRepository = new ItemRepository();
        $cartItemModel = new ItemOnCart();
        $item_id = $itemRepository->getItemByName($clothes)[0]->itemID;

        $data = array(
            "cart_id" => $cart_id,
            "item_id" => $item_id,
            "quantity" => $quantity,
            "description" => $description
        );

        $result = $cartItemModel->insert($data, false);

        if (!$result) {
            return redirect()->to(base_url("/user/select-item"))->with("error", "gagal ditambahkan ke keranjang");
        }
        $session = session();

        $cartRepository = new CartRepository();
        $current_user = $session->current_user[0];
        $account_id = $current_user->id;
        $detailCart = $cartRepository->getDetailCartByAccount($account_id, array("package.packageName", "service.serviceName", "cart.cartId", "item_on_cart.quantity", "item_on_cart.description", "item.itemName", "service.servicePrice", "package.packagePrice", "item.itemPrice", "item.quantityPerKG", "item.itemLogo"));


        dd($detailCart);
        $payload = array(
            "cart" => $detailCart
        );

        $session->set($payload);

        return redirect()->to(base_url("/user/select-item"));
    }
}
