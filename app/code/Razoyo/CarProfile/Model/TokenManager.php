<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Model;

use Magento\Framework\Session\SessionManagerInterface;

class TokenManager
{
    public const CAR_API_TOKEN = 'car_api_token';

    public function __construct(
        protected SessionManagerInterface $session
    )
    {
    }

    public function saveToken($token)
    {
        $this->session->setData(self::CAR_API_TOKEN, $token);
    }

    public function getToken()
    {
        return $this->session->getData(self::CAR_API_TOKEN);
    }
}
