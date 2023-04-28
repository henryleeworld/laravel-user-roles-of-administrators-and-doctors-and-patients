<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    CONST ROLE_ADMIN = 1;
    CONST ROLE_DOCTOR = 2;
    CONST ROLE_PATIENT = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'patent_birth_date' => 'custom_datetime:Y-m-d',
        'doctor_licence_start_date' => 'custom_datetime:Y-m-d',
        'doctor_licence_end_date' => 'custom_datetime:Y-m-d',
    ];

    /**
     * Scope a query to only include doctor fields.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeDoctorFields($query)
    {
        $query->select('name', 'doctor_licence_no', 'doctor_licence_start_date', 'doctor_licence_end_date', 'doctor_stamp_number', 'doctor_hospital_name', 'doctor_department', 'doctor_specialty', 'doctor_biography', 'doctor_work_days', 'doctor_work_hours');
    }

    /**
     * Scope a query to only include patient fields.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopePatientFields($query)
    {
        $query->select('name', 'patent_birth_date', 'patient_declared_address', 'patient_home_address', 'patient_phone_no', 'patient_gender', 'patient_personal_code', 'patient_social_number', 'patient_last_visit_time', 'patient_last_visit_reason', 'patient_description');
    }
}
