<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Support\Traits\UuidAsPrimaryKey;

class DisabilityType extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use UuidAsPrimaryKey;

    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'eligible_for_scnic',
    ];
}
