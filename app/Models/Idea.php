<?php

namespace App\Models;

use App\IdeaStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Idea extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'status' => 'pending',
        'links' => '[]',
    ];

    protected function casts(): array
    {
        return [
            'status' => IdeaStatus::class,
            'links' => 'array',
        ];
    }

    protected function formattedDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::markdown(
                $this->description ?? '',
                [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ]
            ),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    public static function statusCounts(User $user): array
    {
        $counts = $user->ideas()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $result = [];

        foreach (IdeaStatus::cases() as $status) {
            $result[$status->value] = $counts->get($status->value, 0);
        }

        $result['all'] = array_sum($result);

        return $result;
    }
}
