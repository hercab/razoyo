<?php declare(strict_types=1);


namespace Razoyo\CarProfile\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Car extends AbstractDb
{
    public const MAIN_TABLE = 'razoyo_car_profile';
    public const ID_FIELD_NAME = 'id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'car_profile_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
