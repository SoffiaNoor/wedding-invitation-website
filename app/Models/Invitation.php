<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invitation extends Model
{
    protected $fillable = ['name', 'side'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($inv) {
            $base = Str::slug($inv->name);
            $slug = $base;
            $i = 1;
            while (self::where('slug', $slug)->exists()) {
                $slug = "{$base}-" . $i++;
            }
            $inv->slug = $slug;

            do {
                $code = Str::upper(Str::random(10));
            } while (self::where('code', $code)->exists());
            $inv->code = $code;
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
