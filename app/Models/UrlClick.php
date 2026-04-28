<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UrlClick extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'url_id',
        'count',
        'clicked_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class);
    }
}
