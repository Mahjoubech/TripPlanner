<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends User
{
    use HasFactory;

    public function approveOrganizer(Organizer $organizer)
    {
        return $organizer->update([
            'approval_status' => 'approved',
            'is_document_verified' => true
        ]);
    }

    public function rejectOrganizer(Organizer $organizer)
    {
        return $organizer->update([
            'approval_status' => 'rejected',
            'is_document_verified' => false
        ]);
    }
}