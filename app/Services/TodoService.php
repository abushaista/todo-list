<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Support\Collection;

class TodoService implements TodoServiceInterface {
    public function filtered(array $filter) : Collection {
        $data = Todo::query()
            ->when($filter['title'] ?? null, fn ($query, $title) => $query->where('title', 'like', "%$title%"));
    }
    public function create(array $data) : Todo {

    }
    public function update(Todo $todo, array $data) : Todo {

    }
    public function delete(Todo $todo) : void {

    }
    public function find(int $id) : Todo {

    } 
}