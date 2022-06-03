<?php

namespace App\Repositories\Contracts;

use App\Repositories\Support\{
    AdvancedSearchInterface as AdvancedSearch,
    AllInterface as All,
    CreateInterface as Create,
    DeleteInterface as Delete,
    FindInterface as Find,
    SimpleSearchInterface as SimpleSearch,
    UpdateInterface as Update,
};

interface PostRepositoryInterface extends All, AdvancedSearch, Create, Delete, Find, SimpleSearch, Update
{
    // 
}
