<?php

namespace App\Http\Controllers;

use App\Contracts\TodoServiceInterface;
use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(private TodoServiceInterface $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->service->all();

        return response()->json($data);
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $data = $this->service->filtered($validated);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTodoRequest $request)
    {
        $validated = $request->validated();

        $todo = $this->service->create($validated);

        return response()->json($todo);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->service->find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
