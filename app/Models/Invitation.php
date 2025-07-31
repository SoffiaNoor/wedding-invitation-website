<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invitation extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invitation) {
            // 1) Slug from name
            $base = Str::slug($invitation->name);
            $slug = $base;
            $i = 1;
            while (self::where('slug', $slug)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $invitation->slug = $slug;

            // 2) Unique code for barcode
            $invitation->code = (string) Str::uuid();
        });
    }

    // Route model binding by slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
