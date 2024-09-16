<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Plugin;

use Magento\Customer\Model\Customer\DataProviderWithDefaultAddresses;
use Magento\Framework\Exception\NoSuchEntityException;
use Razoyo\CarProfile\Model\CarRepository;

/**
 * Plugin for add Car Profile data in Customer form Data Provider.
 */
class DataProviderWithDefaultAddressesPlugin
{
    public function __construct(
        private CarRepository $carRepository
    )
    {
    }

    /**
     * Add Car profile data to Customer form Data Provider.
     *
     * @param DataProviderWithDefaultAddresses $subject
     * @param array $result
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetData(
        DataProviderWithDefaultAddresses $subject,
        array                            $result
    ): array
    {

        foreach ($result as $id => $entityData) {
            if (!$id) {
                continue;
            }
            try {
                $car = $this->carRepository->getByCustomerId($id);
                $result[$id]['car_profile'] = $car->getData();
            } catch (NoSuchEntityException $e) {
                continue;
            }
        }

        return $result;
    }
}
