<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = ['donatur_id', 'user_id', 'amount', 'proof_file'];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:0',
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

    #[Scope]
    protected function thisMonth(Builder $query): void
    {
        $query->whereMonth('created_at', now()->month);
    }

    #[Scope]
    protected function lastMonth(Builder $query): void
    {
        $query->whereMonth('created_at', now()->subMonth());
    }

    #[Scope]
    protected function withUser(Builder $query, ?User $user): void
    {
        $query->when($user, fn ($q) => $q->where('user_id', $user->id));
    }
}
