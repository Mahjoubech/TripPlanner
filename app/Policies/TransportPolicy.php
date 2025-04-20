<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transport;
use Illuminate\Auth\Access\Response;


class TransportPolicy
{
    /**
     * Create a new policy instance.
     */
    public function modify(User $user, Transport $transport): Response
    {
        
        return $user->id === $transport->organizer_id
            ? Response::allow()
            : Response::deny('You do not have access to this Tronsport');
    }
}
