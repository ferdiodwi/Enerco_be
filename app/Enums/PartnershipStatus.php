<?php

namespace App\Enums;

enum PartnershipStatus: string
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case InProgress = 'in_progress';
    case Completed = 'completed';
}
