<?php

namespace App\Services\Contracts;

use App\Services\Support\{
    AdvancedSearchInterface as AdvancedSearch,
    AllInterface as All,
    CreateInterface as Create,
    DeleteInterface as Delete,
    FindInterface as Find,
    SimpleSearchInterface as SimpleSearch,
    UpdateInterface as Update,
};

interface UserServiceInterface extends All, AdvancedSearch, Create, Delete, Find, SimpleSearch, Update
{
    // 
}
