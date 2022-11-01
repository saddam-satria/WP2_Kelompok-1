<?php

namespace App\Filters;

use App\Repositories\CartRepository;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GetCart implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $current_user = $session->current_user[0];
        $account_id = $current_user->id;
        $cartRepository = new CartRepository();
        $detailCart = $cartRepository->getDetailCartByAccount($account_id, array("package.packageName", "service.serviceName", "cart.cartId", "item_on_cart.quantity", "item_on_cart.description", "item.itemName", "service.servicePrice", "package.packagePrice", "item.itemPrice", "item.quantityPerKG", "item.itemLogo"));
        $cart = $cartRepository->getCartsByUser($account_id, array("cartId"));

        if (count($cart) > 0) {
            $sessionPayload = array(
                "cart_id" => $cart[0]->cartId
            );
            $session->set($sessionPayload);
        }



        if (count($detailCart) > 0) {
            $payload = array(
                "cart" => $detailCart
            );
            $session->set($payload);
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
