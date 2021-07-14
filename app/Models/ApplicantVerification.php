<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Support\Traits\UuidAsPrimaryKey;
use App\Models\User;
use App\Models\Applicant;

class ApplicantVerification extends Model
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
        'user_id',
        'applicant_id',
        'is_verified',
        'is_certificate_issued',
    ];

    /**
     * Get the user that did the verification.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the applicant that the verification is for.
     */
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id', 'id');
    }
}
