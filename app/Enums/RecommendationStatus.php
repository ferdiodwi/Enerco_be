<?php

namespace App\Enums;

enum RecommendationStatus: string
{
    case Draft = 'draft';
    case Reviewed = 'reviewed';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
