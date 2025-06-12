<?php

namespace App\Enums;

enum StatusEnum: string
{
    case Pending = 'pending';
    case Open = 'open';
    case InProgress = 'in_progress';
    case Completed = 'completed';
}
