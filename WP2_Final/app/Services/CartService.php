<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\PackageRepository;
use App\Repositories\ServiceRepository;

class CartService
{

    private $cartRepository;
    private $serviceRepository;
    private $packageRepository;
    public function __construct(CartRepository $cartRepository, ServiceRepository $serviceRepository, PackageRepository $packageRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->serviceRepository = $serviceRepository;
        $this->packageRepository = $packageRepository;
    }
    public function insertToCart(string $user_id, string $service, string $package)
    {

        $service_id = $this->serviceRepository->getServiceByName($service, ["serviceID"])[0]->serviceID;
        $package_id = $this->packageRepository->getPackageByName($package, ["packageID"])[0]->packageID;


        $data = array(
            "account_id" => $user_id,
            "service_id" => (int)$service_id,
            "package_id" => (int) $package_id,
        );

        // dd($data);

        return $this->cartRepository->insert($data);
    }
}
