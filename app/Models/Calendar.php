<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class Calendar extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'days' => 'date:Y-m-d',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
