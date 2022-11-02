<?php

namespace App\Services;

use App\Models\ItemOnCart;
use App\Repositories\CartRepository;
use App\Repositories\ItemRepository;
use App\Repositories\PackageRepository;
use App\Repositories\ServiceRepository;

class CartService
{

    private $cartRepository;
    private $serviceRepository;
    private $packageRepository;
    private $itemOnCartModel;
    public function __construct(CartRepository $cartRepository, ServiceRepository $serviceRepository, PackageRepository $packageRepository, ItemOnCart $itemOnCartModel)
    {
        $this->cartRepository = $cartRepository;
        $this->serviceRepository = $serviceRepository;
        $this->packageRepository = $packageRepository;
        $this->itemOnCartModel = $itemOnCartModel;
    }
    public function insertToCart(string $user_id, string $service, string $package)
    {
        $session = session();
        $service_id = $this->serviceRepository->getServiceByName($service, ["serviceID"])[0]->serviceID;
        $package_id = $this->packageRepository->getPackageByName($package, ["packageID"])[0]->packageID;


        $data = array(
            "account_id" => $user_id,
            "service_id" => (int)$service_id,
            "package_id" => (int) $package_id,
        );

        $result = $this->cartRepository->insert($data);

        if (!$result) {
            return false;
        }


        $sessionPayload = array(
            "cart_id" => $result,
        );
        $session->set($sessionPayload);

        return true;
    }
    public function insertItemOnCart(string $cart_id, string $clothes, int $quantity, string $description): bool
    {

        $itemRepository = new ItemRepository();
        $item_id = $itemRepository->getItemByName($clothes)[0]->itemID;


        $data = array(
            "cart_id" => $cart_id,
            "item_id" => $item_id,
            "quantity" => $quantity,
            "description" => $description
        );

        $response = $this->itemOnCartModel->insert($data);


        if (!$response) {
            return false;
        }

        $session = session();


        $current_user = $session->current_user[0];
        $account_id = $current_user->id;
        $detailCart = $this->cartRepository->getDetailCartByAccount($account_id, array("package.packageName", "service.serviceName", "cart.cartId", "item_on_cart.quantity", "item_on_cart.description", "item.itemName", "service.servicePrice", "package.packagePrice", "item.itemPrice", "item.quantityPerKG", "item.itemLogo"));


        $payload = array(
            "cart" => $detailCart
        );

        $session->set($payload);

        return true;
    }
    public function updateCart(string $item_id, string $action)
    {

        if ($action == "delete") {
            return $this->deleteItemOnCart($item_id);
        }

        $currentCart = $this->itemOnCartModel->where('id', $item_id)->first();

        if (!$currentCart || is_null($currentCart)) {
            return false;
        }

        $currentQuantity = (int) $currentCart["quantity"];

        if ($action == "increase") {
            $currentQuantity = $this->increaseQuantity($currentQuantity);
        }

        if ($action == "decrease") {
            $currentQuantity = $this->decreaseQuantity($currentQuantity);
        }

        $this->itemOnCartModel->update($item_id, array("quantity" => $currentQuantity));
        return true;
    }

    private function increaseQuantity($currentQuantity)
    {
        $currentQuantity = $currentQuantity + 1;


        return $currentQuantity;
    }
    private function decreaseQuantity($currentQuantity)
    {
        $currentQuantity = $currentQuantity - 1;


        return $currentQuantity;
    }
    private function deleteItemOnCart($item_id)
    {
        return $this->itemOnCartModel->delete($item_id);
    }
}
