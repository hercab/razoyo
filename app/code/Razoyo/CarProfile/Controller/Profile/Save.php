<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Controller\Profile;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Razoyo\CarProfile\Api\CarRepositoryInterface;
use Magento\Framework\Message\ManagerInterface as MessageManagerInterface;
use Magento\Framework\App\RequestInterface;
use Razoyo\CarProfile\Api\Data\CarInterfaceFactory;
use Psr\Log\LoggerInterface;

class Save implements HttpPostActionInterface
{
    public function __construct(
        private Session                 $customerSession,
        private ResultFactory           $resultFactory,
        private CarInterfaceFactory     $carFactory,
        private CarRepositoryInterface  $carRepository,
        private MessageManagerInterface $messageManager,
        private RequestInterface        $request,
        private LoggerInterface         $logger
    )
    {
    }

    public function execute()
    {
        $params = json_decode($this->request->getContent(), true);
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $customerId = (int)$this->customerSession->getCustomerId();
        if (!$customerId) {
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('customer/account/login');
        }

        try {
            $params['customer_id'] = $customerId;
            $car = $this->carFactory->create();
            $car->setData($params);

            $car = $this->carRepository->save($car);

            $result->setData([
                'success' => true,
                "message" => "Car profile saved successfully",
                "redirect" => 'car/profile',
                "car" => $car->getData()
            ]);
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
            $result->setData([
                'success' => false,
                "message" => $e->getMessage(),
            ]);
        }

        return $result;
    }
}
