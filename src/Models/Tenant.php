<?php

namespace Devlense\FilamentTenant\Models;

use Filament\Models\Contracts\HasName;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model implements HasName
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public const TITLE = 'title';

    public const EMAIL = 'email';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';



    public function getFilamentName(): string
    {
        return "$this->title";
    }
}
