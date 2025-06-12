<?php

namespace App\Enums;

enum SummaryType: string {
    case Status = 'status';
    case Priority = 'priority';
    case Assignee = 'assignee';
}