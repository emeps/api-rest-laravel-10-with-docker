<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    public function __construct( protected User $model)
    {
       
    }
    
}