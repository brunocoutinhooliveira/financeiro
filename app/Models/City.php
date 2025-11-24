<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function revenues(): HasMany
    {
        return $this->hasMany(Revenue::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'city_user', 'city_id', 'user_id');
    }

    public function getFilamentRecordTitle(): string
    {
        return $this->name;
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }
}
