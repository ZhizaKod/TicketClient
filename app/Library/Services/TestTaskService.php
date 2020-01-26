<?php
namespace App\Library\Services;
namespace App\Library\Services\Interfaces;

use Illuminate\Support\Facades\Config;
use Psr\Http\Message\ResponseInterface;


/**
 * Class TestTicketService
 * @package App\Library\Services
 */

class TeskTaskService implements \App\Library\Services\TestTaskGatewayInterface
{

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * TeskTaskService constructor.
     */
    public function __construct()
    {

        $this->client = new \GuzzleHttp\Client([
            'base_uri'=> Config::get('test-ticket.base_url'),
            'headers' =>  Config::get('test-ticket.headers')
        ]);
    }

    /**
     *
     * @param string $uriPart
     * @param string $method
     * @param null $body
     * @return stdClass[]
     */
    public function apiGetRequest(string $uriPart): array {
        $response = $this->client->get($uriPart);
        return $this->formatResponse($response);
    }

    /**
     * Convert Guzzle ResponseInterface to stdClass[]
     *
     * @param ResponseInterface $response
     * @return stdClass[]
     */
    public function formatResponse(ResponseInterface $response): array{
        return json_decode($response->getBody())->response;
    }


    /**
     * Get all shows
     *
     * @return stdClass[]
     */
    public function getShowsAll(): array {
        return $this->apiGetRequest('shows');
    }

    /**
     * Get an event by Show ID
     * @param int $showId
     * @return stdClass[]
     */

    public function getEvents(int $showId): array {
        return $this->apiGetRequest('shows/' . $showId. '/events');
    }

    /**
     * Get an event by Event Id
     *
     * @param int $eventId
     * @return stdClass[]
     */

    public function getPlaces(int $eventId): array{
        return $this->apiGetRequest('events/' . $eventId. '/places');
    }



    /**
     * Reserve event places for consumer
     *
     * @param int $eventId
     * @param string $consumerName
     * @param array $places
     * @return mixed
     */
    public function reserveEventPlaces(int $eventId, string $consumerName, array $places): Object{

        $options = [
            'form_params' => [
                'name' => $consumerName,
                'places' => $places
            ]
        ];
        return $this->client->post('events/' . $eventId. '/reserve',  $options);
    }


}
?>
