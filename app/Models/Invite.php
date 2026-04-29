<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invite extends Model
{
    protected $fillable = ['send_by', 'send_to', 'company_id', 'role'];

    public function sendBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'send_by');
    }
    public function sendTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'send_to');
    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
