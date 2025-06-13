<?php

namespace App\Http\Controllers;

use App\Contracts\TodoExportInterface;
use App\Contracts\TodoServiceInterface;
use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\TodoUpdateRequest;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(private TodoServiceInterface $service, private TodoExportInterface $export) {}

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

    public function export(SearchRequest $request)
    {
        $validated = $request->validated();
        $data = $this->service->filtered($validated);
        $filePath = $this->export->export($data->toArray());

        return response()->download($filePath)->deleteFileAfterSend(true);
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

    public function chart(Request $request)
    {
        $type = $request->query('type');

        $data = $this->service->summary($type);

        return response()->json($data);
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
    public function update(TodoUpdateRequest $request, int $id)
    {
        $validated = $request->validated();
        $todo = $this->service->find($id);
        if (! $todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }
        $updated = $this->service->update($todo, $validated);

        return response()->json([
            'message' => 'Todo updated successfully.',
            'data' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $todo = $this->service->find($id);
        if (! $todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }
        $this->service - delete($todo);

        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
