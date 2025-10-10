<?php

namespace App\Models;

use App\Enums\DonationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'donatur_id',
        'user_id',
        'amount',
        'type',
        'proof_file',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:0',
            'type' => DonationType::class,
        ];
    }

    public function donatur(): BelongsTo
    {
        return $this->belongsTo(Donatur::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
