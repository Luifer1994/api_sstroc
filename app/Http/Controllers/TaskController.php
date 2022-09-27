<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTypeContracRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //list paginated tasks
    public function listPaginate(Request $request)
    {
        $limit = $request["limit"] ?? $limit = 10;
        $Tasks = Task::select(
            'tasks.*',
        )->where('tasks.name', 'like', '%'.$request["search"].'%')
            ->orderBy('tasks.id', 'DESC')
            ->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $Tasks
        ], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'res' => true,
            'data' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTypeContracRequest $request)
    {
        $task = Task::create($request->all());
        if (!empty($task)) {
            return response()->json([
                'res' => true,
                'message' => 'Registro exitoso',
                'data' => $task,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al registrar la tarea',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $task = Task::find($id);
        if (!empty($task)) {
            return response()->json([
                'res' => true,
                'message' => 'ok',
                'data' => $task,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'No se encontro la tarea',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTypeContracRequest $request, int $id)
    {
        $task = Task::find($id);
        if (!empty($task)) {
            $task->update($request->all());
            return response()->json([
                'res' => true,
                'message' => 'Actualización exitosa',
                'data' => $task,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al actualizar la tarea',
                'data' => null,
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $task = Task::find($id);
        if (!empty($task)) {
            $task->delete();
            return response()->json([
                'res' => true,
                'message' => 'Eliminación exitosa',
                'data' => $task,
            ], 200);
        } else {
            return response()->json([
                'res' => false,
                'message' => 'Error al eliminar la tarea',
                'data' => null,
            ], 400);
        }
    }
}
