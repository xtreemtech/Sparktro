<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($role) {
            if (empty($role->slug)) {
                $role->slug = Str::slug($role->name);
            }
        });

        static::updating(function ($role) {
            if (empty($role->slug) || $role->isDirty('name')) {
                $role->slug = Str::slug($role->name);
            }
        });
    }
}
