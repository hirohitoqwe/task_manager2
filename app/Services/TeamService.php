<?php

namespace App\Services;

class TeamService
{
    public function createCode(string $name): string
    {
        return hash('sha256', $name);
    }
}
