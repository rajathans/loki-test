<?php

namespace App\Services;

use App\User;

class UserService
{
    /**
     * Get metrics for the user
     *
     * @param User $user
     * @return array
     */
    public function getMetrics(User $user)
    {
        $total_size = $user->videos()->with('metadata')->get()->sum('metadata.size');

        return [
            'total_size' => $total_size
        ];
    }
}
