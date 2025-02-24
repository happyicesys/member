<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Billable, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'dob',
        'name',
        'email',
        'email_verified_at',
        'is_admin',
        'is_details_filled',
        'is_phone_number_validated',
        'login_count',
        'password',
        'phone_country_id',
        'phone_number',
        'phone_number_verified_at',
        'ref_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'email_verified_at' => 'datetime',
            'is_admin' => 'boolean',
            'is_details_filled' => 'boolean',
            'is_phone_number_validated' => 'boolean',
            'password' => 'hashed',
            'phone_number_verified_at' => 'datetime',
        ];
    }

    // relationships
    public function phoneCountry()
    {
        return $this->belongsTo(Country::class, 'phone_country_id');
    }

    public function planItemUser()
    {
        return $this->hasOne(PlanItemUser::class)->latestOfMany();
    }

}
