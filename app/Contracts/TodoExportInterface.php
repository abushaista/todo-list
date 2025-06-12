<?php

namespace App\Contracts;

interface TodoExportInterface {
    public function export(array $data): string;
}