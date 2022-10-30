<?php

namespace App\Filters;

use App\Repositories\CartRepository;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsCartEmpty implements FilterInterface
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
        $currentCart = $session->cart_id;
        $currentUser = $session->current_user[0];
        $account_id = $currentUser->id;

        $currentPATH = current_url();
        $isSelectItemPage = str_contains($currentPATH, "select-item");

        if (!is_null($currentCart) && !$isSelectItemPage) {
            return redirect()->to(base_url("/user/select-item"));
        }

        $cartRepository = new CartRepository();

        $cart = $cartRepository->getCartsByUser($account_id, array("cartId"));
        if (count($cart) > 0 && !$isSelectItemPage && is_null($currentCart)) {
            $sessionPayload = array(
                "cart_id" => $cart[0]->cartId
            );
            $session->set($sessionPayload);
            return redirect()->to(base_url("/user/select-item"));
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
