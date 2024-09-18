<?php

namespace Devlense\FilamentTenant\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model implements HasName
{
    use HasFactory, SoftDeletes;


    protected $guarded = [];

    public const TITLE = 'title';

    public const CURRENCY = 'currency';

    public const MEASUREMENT_SYSTEM = 'measurement_system';

    public const EMAIL = 'email';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function getFilamentName(): string
    {
        return "$this->title";
    }
}
