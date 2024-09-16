<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Api;

use Razoyo\CarProfile\Api\Data\CarInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Car CRUD Interface
 *
 * @api
 * @since 1.0.0
 */
interface CarRepositoryInterface
{

    /**
     * Get Entity by ID
     *
     * @param mixed $id
     * @return CarInterface
     * @throw LocalizedException
     */
    public function getById($id): CarInterface;

    /**
     * Get Entity by Customer ID
     *
     * @param mixed $customerId
     * @return CarInterface
     * @throw LocalizedException
     */
    public function getByCustomerId($customerId): CarInterface;

    /**
     * Save Car
     *
     * @param CarInterface $car
     * @return CarInterface
     * @throw LocalizedException
     */
    public function save(CarInterface $car): CarInterface;

    /**
     * Delete Car by ID
     *
     * @param mixed $id
     * @return bool
     * @throw LocalizedException
     * @throw NoSuchEntityException
     */
    public function deleteById($id): bool;
}
