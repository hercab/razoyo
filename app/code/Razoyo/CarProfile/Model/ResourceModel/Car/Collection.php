<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Model\ResourceModel\Car;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Razoyo\CarProfile\Model\ResourceModel\Car as CarResourceModel;
use Razoyo\CarProfile\Model\Car;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'car_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Car::class, CarResourceModel::class);
    }
}
