<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $dataService = new  \App\Library\Services\Interfaces\TeskTaskService();
    $dataAdapterService = new \App\Library\Services\DataDisplayAdapterService();

    $shows = $dataService->getShowsAll();
    $showsDisplay = $dataAdapterService->prepareDataToDisplay('\App\Library\Models\Show' ,  $shows);

    return View::make('show-list', ["shows" =>  $showsDisplay]);
});

Route::get('show/{showId}', function ($showId) {
    $dataService = new  \App\Library\Services\Interfaces\TeskTaskService();
    $dataAdapterService = new \App\Library\Services\DataDisplayAdapterService();

    $events = $dataService->getEvents($showId);
    $eventsDisplay = $dataAdapterService->prepareDataToDisplay('\App\Library\Models\Event' ,  $events);

    return  View::make('show-event-list', ["events" =>  $eventsDisplay, "showId" => $showId]);
});

Route::get('event/{eventId}', function ($eventId) {
    $service = new  \App\Library\Services\Interfaces\TeskTaskService();
    $eventPlaces = $service->getPlaces($eventId);

    return  View::make('show-event-detail', ["eventDetails" =>  $eventPlaces, "eventId" => $eventId]);
});

Route::post('reserve', 'ReserveController@handleRequest');

