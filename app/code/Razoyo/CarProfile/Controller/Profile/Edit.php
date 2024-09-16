<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Controller\Profile;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\NoSuchEntityException;
use Razoyo\CarProfile\Api\CarRepositoryInterface;

class Edit implements HttpGetActionInterface
{
    public function __construct(
        protected ResultFactory          $resultFactory,
        protected Session                $customerSession,
        protected CarRepositoryInterface $carRepository
    )
    {
    }

    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $customerId = (int)$this->customerSession->getCustomerId();
        if (!$customerId) {
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('customer/account/login');
        }
        try {
            $car = $this->carRepository->getByCustomerId($customerId);
            $block = $result->getLayout()->getBlock('customer_car_profile_form');
            $block->setData('car', $car);
        } catch (NoSuchEntityException $e) {
        }

        return $result;
    }
}
