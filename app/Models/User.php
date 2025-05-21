<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'converted_at',
        'dob',
        'name',
        'email',
        'email_verified_at',
        'is_active',
        'is_admin',
        'is_converted',
        'is_converted_voucher_used',
        'is_details_filled',
        'is_one_time_voucher_used',
        'is_phone_number_validated',
        'is_unsubscribe_email',
        'login_count',
        'meta_json',
        'password',
        'phone_country_id',
        'phone_number',
        'phone_number_verified_at',
        'referral_code',
        'ref_id',
        'vend_code',
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
            'converted_at' => 'datetime',
            'dob' => 'date',
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
            'is_admin' => 'boolean',
            'is_converted' => 'boolean',
            'is_converted_voucher_used' => 'boolean',
            'is_details_filled' => 'boolean',
            'is_one_time_voucher_used' => 'boolean',
            'is_phone_number_validated' => 'boolean',
            'is_unsubscribe_email' => 'boolean',
            'meta_json' => 'json',
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
        return $this->hasOne(PlanItemUser::class)->where('is_active', true)->latestOfMany();
    }

    public function referral()
    {
        return $this->hasOne(Referral::class);
    }

    public function vendTransactions()
    {
        return $this->hasMany(VendTransaction::class);
    }

    // mutator or setter
    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value ? str_replace(' ', '', $value) : null,
        );
    }

}
