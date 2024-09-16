<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Model;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Razoyo\CarProfile\Api\CarRepositoryInterface;
use Razoyo\CarProfile\Api\Data\CarInterface;
use Razoyo\CarProfile\Model\ResourceModel\Car as CarResourceModel;

class CarRepository implements CarRepositoryInterface
{
    public function __construct(
        private CarFactory       $carFactory,
        private CarResourceModel $carResourceModel
    )
    {
    }

    /**
     * @inheriDoc
     */
    public function getByCustomerId($customerId): CarInterface
    {
        $car = $this->carFactory->create();
        $this->carResourceModel->load($car, $customerId, 'customer_id');

        if (!$car->getId()) {
            throw new NoSuchEntityException(__('Car with customer id "%1" does not exist.', $customerId));
        }
        return $car;
    }

    /**
     * @inheriDoc
     */
    public function getById($id): CarInterface
    {
        $car = $this->carFactory->create();
        $this->carResourceModel->load($car, $id);

        if (!$car->getId()) {
            throw new NoSuchEntityException(__('Car with id "%1" does not exist.', $id));
        }
        return $car;
    }

    /**
     * @inheriDoc
     */
    public function save(CarInterface $car): CarInterface
    {
        try {
            $existingCar = $this->getByCustomerId($car->getCustomerId());

            if ($existingCar) {
                $car->setId($existingCar->getId());
            }

            $this->carResourceModel->save($car);
        } catch (NoSuchEntityException $e) {
            $this->carResourceModel->save($car);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $car;
    }

    /**
     * @inheriDoc
     */
    public function deleteById($id): bool
    {
        $car = $this->getById($id);

        try {
            $this->carResourceModel->delete($car);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }
}
