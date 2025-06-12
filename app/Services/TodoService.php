<?php

namespace App\Services;

use App\Contracts\TodoServiceInterface;
use App\Models\Todo;
use Illuminate\Support\Collection;
use App\Enums\SummaryType;
use DB;

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

    public function summary(string $type): array {
        if($type == SummaryType::Status->value) {
            $data = Todo::query()
                ->select('status', DB::raw('count(1) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();
            return [
                'status_summary' => $data
            ];
        } else if($type == SummaryType::Priority->value) {
            $data = Todo::query()
                ->select('priority', DB::raw('count(1) as total'))
                ->groupBy('priority')
                ->pluck('total', 'priority')
                ->toArray();
            return [
                'proprity_summary' => $data
            ];
        } else if($type == SummaryType::Assignee->value) {
            $data = Todo::select([
                    'assignee',
                    DB::raw('COUNT(*) as total_todos'),
                    DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as total_pending"),
                    DB::raw("SUM(CASE WHEN status = 'completed' THEN time_tracked ELSE 0 END) as total_time_tracked_completed")
                ])
                ->groupBy('assignee')
                ->get();
            return [
                'assignee_summary' => $data->keyBy('assignee')->map(function ($item) {
                    return [
                        'total_todos' => (int) $item->total_todos,
                        'total_pending' => (int) $item->total_pending,
                        'total_time_tracked_completed' => (float) $item->total_time_tracked_completed,
                        ];
                    })
                ];
        } 
        return [];
    }

    public function create(array $data): Todo
    {
        return Todo::create($data);
    }

    public function update(Todo $todo, array $data): Todo {}

    public function delete(Todo $todo): void {
        $todo->delete();
    }

    public function find(int $id): Todo
    {
        return Todo::findOrFail($id);
    }

    public function all(): Collection
    {
        return Todo::all();
    }
}
