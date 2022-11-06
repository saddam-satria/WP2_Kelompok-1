<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home');
// $routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group("auth", function ($routes) {
    $routes->get("login", "Auth\LoginController::index");
    $routes->post("login", "Auth\LoginController::login");

    $routes->get("signup", "Auth\RegisterController::index");
    $routes->post("signup", "Auth\RegisterController::signup");


    $routes->post("logout", "Auth\LogoutController::logout");
});

$routes->group("user", array("filter" => "getCart"), function ($routes) {
    $routes->get("dashboard", "User\DashboardController::index");
    $routes->get("profile", "User\ProfileController::index");
    $routes->post("profile", "User\ProfileController::update");
    $routes->post("update-password", "User\ProfileController::updatePassword");
    $routes->get("orders", "User\OrderController::index");
    $routes->get("order/(:any)", "User\OrderController::detail/$1");
    $routes->get("histories", "User\OrderController::histories");
    $routes->get("notification/(:any)", "User\NotificationController::index/$1");
    $routes->post("notification/(:any)", "User\NotificationController::updateIsRead/$1");

    $routes->group("", array("filter" => "currentCart"), function ($routes) {
        $routes->get("new-order", "User\OrderController::create");
    });

    $routes->post("add-item-to-cart",  "User\CartController::storeItem");
    $routes->post("add-to-cart", "User\CartController::store");

    $routes->group("", array("filter" => "isCartEmpty"), function ($routes) {
        $routes->get("checkout", "User\CheckoutController::index");
        $routes->post("payment", "User\CheckoutController::payment");
        $routes->get("select-item", "User\CartController::create");
        $routes->post("select-voucher", "User\CheckoutController::selectVoucher");
    });
    $routes->get("payment", "User\OrderController::orderComplete");
    $routes->get("cart", "User\CartController::index");
    $routes->post("cart", "User\CartController::updateCart");


    $routes->post("claim-voucher", "User/VoucherController::claimingVoucher");
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
