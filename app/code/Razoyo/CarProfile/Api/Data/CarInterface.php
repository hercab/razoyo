<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Api\Data;

/**
 * Interface CarInterface
 *
 * @api
 * @since 1.0.0
 */
interface CarInterface
{
    public const ID = 'id';
    public const CAR_ID = 'car_id';
    public const YEAR = 'year';
    public const MAKE = 'make';
    public const MODEL = 'model';
    public const PRICE = 'price';
    public const SEATS = 'seats';
    public const MPG = 'mpg';
    public const IMAGE = 'image';
    public const CUSTOMER_ID = 'customer_id';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);
    
    /**
     * Get ID
     *
     * @return string
     */
    public function getCarId(): string;

    /**
     * Set ID
     *
     * @param string $id
     * @return CarInterface
     */
    public function setCarId(string $id): CarInterface;

    /**
     * Get Year
     *
     * @return mixed
     */
    public function getYear(): mixed;

    /**
     * Set Year
     *
     * @param mixed $year
     * @return CarInterface
     */
    public function setYear($year): CarInterface;

    /**
     * Get Make
     *
     * @return mixed
     */
    public function getMake(): mixed;

    /**
     * Set Make
     *
     * @param mixed $make
     * @return CarInterface
     */
    public function setMake($make): CarInterface;

    /**
     * Get Model
     *
     * @return mixed
     */
    public function getModel(): mixed;

    /**
     * Set Model
     *
     * @param mixed $model
     * @return CarInterface
     */
    public function setModel($model): CarInterface;

    /**
     * Get Price
     *
     * @return mixed
     */
    public function getPrice(): mixed;

    /**
     * Set Price
     *
     * @param mixed $price
     * @return CarInterface
     */
    public function setPrice($price): CarInterface;

    /**
     * Get Seats
     *
     * @return mixed
     */
    public function getSeats(): mixed;

    /**
     * Set Seats
     *
     * @param mixed $seats
     * @return CarInterface
     */
    public function setSeats($seats): CarInterface;

    /**
     * Get MPG
     *
     * @return mixed
     */
    public function getMpg(): mixed;

    /**
     * Set MPG
     *
     * @param mixed $mpg
     * @return CarInterface
     */
    public function setMpg($mpg): CarInterface;

    /**
     * Get Image
     *
     * @return mixed
     */
    public function getImage(): mixed;

    /**
     * Set Image
     *
     * @param string $image
     * @return CarInterface
     */
    public function setImage($image): CarInterface;

    /**
     * Get Customer ID
     *
     * @return mixed
     */
    public function getCustomerId(): mixed;

    /**
     * Set Customer ID
     *
     * @param mixed $customerId
     * @return CarInterface
     */
    public function setCustomerId($customerId): CarInterface;
}
