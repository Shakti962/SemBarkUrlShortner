<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email'];


    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function urls(): HasMany
    {
        return $this->hasMany(Url::class);
    }
    public function urlClicks(): HasMany
    {
        return $this->hasMany(UrlClick::class);
    }
}
