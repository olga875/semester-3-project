<?php

namespace App\Enums;

enum AccessLevels : string
{
    case NONE = "none";
    case OFFICE = 'office';
    case CLEANING = 'cleaning';
    case ADMIN = 'admin';
}

enum ApprovalState : string
{
    case SUBMITTED = 'submitted';
    case REJECTED = 'rejected';
    case APPROVED = 'approved';
}