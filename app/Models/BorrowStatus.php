<?php

namespace App\Models;

enum BorrowStatus: string
{
    case PENDING = 'PENDING';
    case REJECTED = 'REJECTED';
    case ACCEPTED = 'ACCEPTED';
    case RETURNED = 'RETURNED';
}
