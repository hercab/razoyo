<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Model;

use Magento\Framework\Model\AbstractModel;
use Razoyo\CarProfile\Api\Data\CarInterface;
use Razoyo\CarProfile\Model\ResourceModel\Car as ResourceModel;

class Car extends AbstractModel implements CarInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getMake(): mixed
    {
        return $this->getData(self::MAKE);
    }

    /**
     * @inheritDoc
     */
    public function setMake($make): CarInterface
    {
        return $this->setData(self::MAKE, $make);
    }

    /**
     * @inheritDoc
     */
    public function getModel(): mixed
    {
        return $this->getData(self::MODEL);
    }

    /**
     * @inheritDoc
     */
    public function setModel($model): CarInterface
    {
        return $this->setData(self::MODEL, $model);
    }

    /**
     * @inheritDoc
     */
    public function getYear(): mixed
    {
        return (int)$this->getData(self::YEAR);
    }

    /**
     * @inheritDoc
     */
    public function setYear($year): CarInterface
    {
        return $this->setData(self::YEAR, $year);
    }

    /**
     * @inheritDoc
     */
    public function getPrice(): string
    {
        return number_format((float)$this->getData(self::PRICE), 2);
    }

    /**
     * @inheritDoc
     */
    public function setPrice($price): CarInterface
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritDoc
     */
    public function getSeats(): mixed
    {
        return (int)$this->getData(self::SEATS);
    }

    /**
     * @inheritDoc
     */
    public function setSeats($seats): CarInterface
    {
        return $this->setData(self::SEATS, $seats);
    }

    /**
     * @inheritDoc
     */
    public function getMpg(): mixed
    {
        return (int)$this->getData(self::MPG);
    }

    /**
     * @inheritDoc
     */
    public function setMpg($mpg): CarInterface
    {
        return $this->setData(self::MPG, $mpg);
    }

    /**
     * @inheritDoc
     */
    public function getImage(): mixed
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage($image): CarInterface
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId(): mixed
    {
        return (int)$this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId($customerId): CarInterface
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function getCarId(): string
    {
        return $this->getData(self::CAR_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCarId($id): CarInterface
    {
        return $this->setData(self::CAR_ID, $id);
    }
}
