<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEvenetRequest;
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

    //find event by id
    public function findEvent($id)
    {
        $event = Event::find($id);
        return response()->json([
            "message" => "Evento obtenido correctamente",
            "data" => $event
        ], 200);
    }

    //update event
    public function update(UpdateEvenetRequest $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                "res" => false,
                "message" => "Evento no encontrado",
                "data" => $event
            ], 404);
        }
        $event->update($request->all());
        return response()->json([
            "res" => true,
            "message" => "Evento actualizado correctamente",
            "data" => $event
        ], 200);
    }

    //delete event by id
    public function delete($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                "res" => false,
                "message" => "Evento no encontrado",
                "data" => $event
            ], 404);
        }
        $event->delete();
        return response()->json([
            "res" => true,
            "message" => "Evento eliminado correctamente",
        ], 200);
    }
}
