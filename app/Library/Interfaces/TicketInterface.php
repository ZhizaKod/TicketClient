<?php
namespace App\Library\Services;

use App\Library\Models\Place;
use App\Library\Models\Show;
use App\Library\Models\Event;


/**
 * Interface TestTaskGatewayInterface
 * @package App\Library\Services
 */

interface TestTaskGatewayInterface
{

    /**
     * Get all shows
     *
     * @return Show[] list of shows
     */
    public function getShowsAll();

    /**
     * Get an event by Show ID
     * @param int $showId
     * @return Event
     */

    public function getEvents(int $showId);

    /**
     * @param int $eventId
     * @return Place[]
     */

    public function getPlaces(int $eventId);

    /**
     * Reserve event places for consumer
     *
     * @param int $eventId
     * @param string $consumerName
     * @param array $places
     * @return mixed
     */
    public function reserveEventPlaces(int $eventId, string $consumerName, array $places);
}

