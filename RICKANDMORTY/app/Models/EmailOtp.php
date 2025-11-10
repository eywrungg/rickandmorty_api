<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EmailOtp extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_otps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'otp',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope to get only valid (non-expired) OTPs
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeValid($query)
    {
        return $query->where('expires_at', '>', Carbon::now());
    }

    /**
     * Scope to get expired OTPs
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<=', Carbon::now());
    }

    /**
     * Check if this OTP is expired
     *
     * @return bool
     */
    public function isExpired()
    {
        return Carbon::now()->isAfter($this->expires_at);
    }

    /**
     * Check if this OTP is still valid
     *
     * @return bool
     */
    public function isValid()
    {
        return !$this->isExpired();
    }

    /**
     * Get the expiration time in human readable format
     *
     * @return string
     */
    public function getExpiresInAttribute()
    {
        if ($this->isExpired()) {
            return 'Expired';
        }
        return $this->expires_at->diffForHumans();
    }

    /**
     * Boot method to add model events
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically clean up expired OTPs when querying
        static::retrieved(function ($otp) {
            if ($otp->isExpired()) {
                \Log::info("Expired OTP accessed for email: {$otp->email}");
            }
        });
    }
}