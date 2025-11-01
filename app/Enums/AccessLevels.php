<?php

namespace App\Enums;

enum AccessLevels : string
{
    case NONE = "none";
    case USER = 'user';
    case STAFF = 'staff';
    case ADMIN = 'admin';
}

enum ApprovalState : string
{
    case SUBMITTED = 'submitted';
    case REJECTED = 'rejected';
    case APPROVED = 'approved';
}