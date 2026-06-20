<?php

namespace App\Shared\Models;

use App\Shared\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasUuid;

    /**
     * Permite asignación masiva controlada desde FormRequest/Services.
     *
     * La seguridad no estará en fillable, sino en validaciones,
     * DTOs y servicios de aplicación.
     */
    protected $guarded = [];
}
