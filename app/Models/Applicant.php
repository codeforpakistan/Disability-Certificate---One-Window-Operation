<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Support\Traits\UuidAsPrimaryKey;
use App\Models\User;
use App\Models\ApplicantAssesment;
use App\Models\ApplicantVerification;
use App\Models\Resource;
use App\Models\Status;
use App\Models\DisabilityType;

class Applicant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    use UuidAsPrimaryKey;

    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'cnic',
        'registration_no',
        'dob',
        'name',
        'father_name',
        'phone_no',
        'address',
        'gender',
        'marital_status',
        'spouse_name',
        'qualification',
        'type_of_disability',
        'nature_of_disability',
        'cause_of_disability',
        'source_of_income',
        'type_of_job',
        'status',
        'comments'
    ];

    /**
     * Get the user that created this applicant.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the status for this applicant.
     */
    public function applicationStatus()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }

    /**
     * Get the disability type for this applicant.
     */
    public function disabilityType()
    {
        return $this->belongsTo(DisabilityType::class, 'type_of_disability', 'id');
    }

    /**
     * Get the assessments that a applicant has.
     */
    public function assessments()
    {
        return $this->hasMany(ApplicantAssesment::class, 'applicant_id', 'id');
    }

    /**
     * Get the resources that a applicant has.
     */
    public function resources()
    {
        return $this->hasMany(Resource::class, 'applicant_id', 'id');
    }

    /**
     * Get the verification that a applicant has.
     */
    public function verification()
    {
        return $this->hasMany(ApplicantVerification::class, 'applicant_id', 'id');
    }
}
