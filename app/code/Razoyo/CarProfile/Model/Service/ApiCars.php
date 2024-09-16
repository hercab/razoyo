<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Model\Service;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Session\SessionManagerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use GuzzleHttp\Utils;
use Razoyo\CarProfile\Model\TokenManager;

/**
 * Razoyo Cars Service
 */
class ApiCars
{
    private const API_TOKEN_FIELD = 'your-token';
    private const API_BASE_URL = 'https://exam.razoyo.com/api/';
    private const API_CARS_ENDPOINT = 'cars/';

    /**
     * ApiCars constructor.
     *
     * @param SessionManagerInterface $session
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     * @param ScopeSetting $klaviyoScopeSetting
     * @param LoggerInterface $logger
     */
    public function __construct(
        private SessionManagerInterface $session,
        private ClientFactory           $clientFactory,
        private ResponseFactory         $responseFactory,
        private LoggerInterface         $logger
    )
    {
    }

    /**
     * Get car list from API
     *
     * @return array
     * @throws LocalizedException
     */
    public function getCarList(): array
    {
        $endPoint = self::API_BASE_URL . self::API_CARS_ENDPOINT;
        $response = $this->doRequest($endPoint);
        $token = $response->getHeader(self::API_TOKEN_FIELD)[0];
        $this->session->setData(TokenManager::CAR_API_TOKEN, $token);
        $responseBody = $response->getBody()->getContents();
        return Utils::jsonDecode($responseBody, true);
    }

    /**
     * Get Car Details by ID
     *
     * @param string $carId
     * @return array
     * @throws LocalizedException
     */
    public function getCarById(string $carId): array
    {
        $endPoint = self::API_BASE_URL . self::API_CARS_ENDPOINT . $carId;
        $token = $this->session->getData(TokenManager::CAR_API_TOKEN);
        $response = $this->doRequest($endPoint, $token);
        $responseBody = $response->getBody()->getContents();
        return Utils::jsonDecode($responseBody, true)['car'];
    }

    /**
     * Do API request with provided params
     *
     * @param string $endPoint
     * @param string $token
     * @return ResponseInterface
     * @throws LocalizedException
     */
    public function doRequest(string $endPoint, $token = ""): ResponseInterface
    {
        /** @var Client $client */
        $client = $this->clientFactory->create();
        $headers = [
            "Content-Type" => "application/json",
        ];

        if ($token) {
            $headers["Authorization"] = "Bearer " . $token;
        }

        try {
            $response = $client->request(
                'GET',
                $endPoint,
                [
                    'headers' => $headers,
                ]
            );
        } catch (GuzzleException $exception) {
            $this->logger->error($exception->getMessage());
            throw new LocalizedException(__('An error occurred while processing your request.'));
        }
        return $response;
    }
}
