<?php declare(strict_types=1);


namespace Razoyo\CarProfile\Controller\Profile;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Razoyo\CarProfile\Api\CarRepositoryInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Magento\Framework\App\RequestInterface;

class Delete implements HttpGetActionInterface
{
    public function __construct(
        private Session                 $customerSession,
        private ResultFactory           $resultFactory,
        private CarRepositoryInterface  $carRepository,
        private MessageManagerInterface $messageManager,
        private RequestInterface        $request
    )
    {
    }

    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $carId = $this->request->getParam('car_id');
        if (!$carId) {
            $this->messageManager->addErrorMessage(__('Invalid car ID.'));
            return $resultRedirect->setPath('customer/account/index');
        }

        try {
            $customerId = (int)$this->customerSession->getCustomerId();
            if (!$customerId) {
                throw new LocalizedException(__('Customer not logged in.'));
            }

            $car = $this->carRepository->getByCustomerId($customerId);

            if (!$car || $car->getCarId() !== $carId) {
                throw new LocalizedException(__('Car profile not found or does not belong to this customer.'));
            }

            $this->carRepository->deleteById($car->getId());
            $this->messageManager->addSuccessMessage(__('Car profile deleted successfully.'));
            return $resultRedirect->setPath('customer/account/index');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while deleting the car profile.'));
        }

        return $resultRedirect->setPath('customer/account/index');
    }
}
