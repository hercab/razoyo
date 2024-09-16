<?php

namespace Razoyo\CarProfile\Model;

use Razoyo\CarProfile\Api\CarManagementInterface;
use Razoyo\CarProfile\Api\Data\CarInterface;
use Razoyo\CarProfile\Api\Data\CarInterfaceFactory;
use Razoyo\CarProfile\Api\Data\CarSearchResultsInterface;
use Razoyo\CarProfile\Api\Data\CarSearchResultsInterfaceFactory;
use Razoyo\CarProfile\Model\Service\ApiCars;

class CarManagement implements CarManagementInterface
{
    /**
     * @param CarSearchResultsInterfaceFactory $searchResultsFactory
     * @param ApiCars $apiCars
     */
    public function __construct(
        private ApiCars                          $apiCars,
        private CarSearchResultsInterfaceFactory $searchResultsFactory,
        private CarInterfaceFactory              $carInterfaceFactory
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getCarList(): CarSearchResultsInterface
    {
        $items = [];
        $searchResults = $this->searchResultsFactory->create();
        $result = $this->apiCars->getCarList();
        $searchResults->setTotalCount(count($result['cars']));
        foreach ($result['cars'] as $item) {
            $items[] = $item;
        }
        return $searchResults->setItems($items);
    }

    /**
     * @inheritDoc
     */
    public function getCarDetail(string $carId): CarInterface
    {
        $result = $this->apiCars->getCarById($carId);
        $car = $this->carInterfaceFactory->create();
        $car->setData($result);
        $car->setCarId($carId);
        return $car;
    }
}
