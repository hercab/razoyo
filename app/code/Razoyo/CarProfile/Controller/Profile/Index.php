<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Controller\Profile;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Razoyo\CarProfile\Api\CarRepositoryInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;

class Index implements HttpGetActionInterface
{
    public function __construct(
        private Session                 $customerSession,
        private ResultFactory           $resultFactory,
        private CarRepositoryInterface  $carRepository,
        private MessageManagerInterface $messageManager
    )
    {
    }

    public function execute()
    {
        $customerId = (int)$this->customerSession->getCustomerId();
        if (!$customerId) {
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('customer/account/login');
        }
        try {
            $car = $this->carRepository->getByCustomerId($customerId);
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $block = $result->getLayout()->getBlock('customer_car_profile');
            $block->setData('car', $car);
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addNoticeMessage(__('Please fill in your car profile.'));
            $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $result->setPath('car/profile/edit');
        }

        return $result;
    }
}
