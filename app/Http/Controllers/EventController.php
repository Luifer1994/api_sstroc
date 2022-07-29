<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        $request["user_id"] = auth()->id();
        $event = Event::create($request->all());
        return response()->json([
            "message" => "Evento creado correctamente",
            "data" => $event
        ], 200);
    }

    //List evenet the user loged in
    public function eventUser()
    {
        $events = Event::where("user_id", auth()->id())->get();
        return response()->json([
            "message" => "Eventos obtenidos correctamente",
            "data" => $events
        ], 200);
    }
}
