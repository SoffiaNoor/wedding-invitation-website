<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['invitation_id'];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
