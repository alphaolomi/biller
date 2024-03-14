<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = ['house_id', 'description', 'amount', 'currency', 'due_date', 'type', 'shared'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'datetime',
        'shared' => 'boolean',
    ];

    // Relationships
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
