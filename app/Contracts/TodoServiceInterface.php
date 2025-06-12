<?php

namespace App\Contracts;

use App\Models\Todo;
use Illuminate\Support\Collection;

interface TodoServiceInterface
{
    public function filtered(array $filter): Collection;

    public function create(array $data): Todo;

    public function update(Todo $todo, array $data): Todo;

    public function delete(Todo $todo): void;

    public function find(int $id): Todo;

    public function all(): Collection;
}
