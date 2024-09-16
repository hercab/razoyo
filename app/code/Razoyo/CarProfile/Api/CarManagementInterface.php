<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Api;

use Razoyo\CarProfile\Api\Data\CarInterface;
use Razoyo\CarProfile\Api\Data\CarSearchResultsInterface;

interface CarManagementInterface
{
    /**
     * Get car list
     *
     * @return CarSearchResultsInterface
     * @throw LocalizedException
     */
    public function getCarList(): CarSearchResultsInterface;

    /**
     * Get car by id
     *
     * @param string $carId
     * @return CarInterface
     * @throw LocalizedException
     */
    public function getCarDetail(string $carId): CarInterface;
}
