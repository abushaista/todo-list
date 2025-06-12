<?php

namespace App\Services;

use App\Contracts\TodoServiceInterface;
use App\Models\Todo;
use Illuminate\Support\Collection;

class TodoService implements TodoServiceInterface
{
    public function filtered(array $filter): Collection
    {
        $data = Todo::query()
            ->when($filter['title'] ?? null, fn ($query, $title) => $query->where('title', 'like', "%$title%"))
            ->when($filter['assignee'] ?? null, function ($query, $assignee) {
                $assignees = is_array($assignee) ? $assignee : explode(',', $assignee);
                $query->whereIn('assignee', $assignees);
            })
            ->when($filter['priority'] ?? null, function ($query, $priority) {
                $assignees = is_array($priority) ? $assignee : explode(',', $priority);
                $query->whereIn('priority', $assignees);
            })
            ->when($filter['status'] ?? null, function ($query, $status) {
                $assignees = is_array($status) ? $assignee : explode(',', $status);
                $query->whereIn('status', $assignees);
            })
            ->when($filter['time_tracked'] ?? null, function ($query, $time_track) {
                $query->whereBetween('time_tracked', [$time_track['min'], $time_track['max']]);
            })
            ->when($filter['due_date'] ?? null, function ($query, $due_date) {
                $query->whereBetween('due_date', [$due_date['start'], $due_date['end']]);
            })->get();

        return $data;
    }

    public function create(array $data): Todo
    {
        return Todo::create($data);
    }

    public function update(Todo $todo, array $data): Todo {}

    public function delete(Todo $todo): void {}

    public function find(int $id): Todo
    {
        return Todo::findOrFail($id);
    }

    public function all(): Collection
    {
        return Todo::all();
    }
}
