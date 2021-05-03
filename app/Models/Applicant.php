<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\ApplicantAssesment;
use App\Models\ApplicantVerification;
use App\Models\Resource;

class Applicant extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'cnic',
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
    ];

    /**
     * Get the user that created this applicant.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
        return $this->hasOne(ApplicantVerification::class, 'applicant_id', 'id');
    }
}
