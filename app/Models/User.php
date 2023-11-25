<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'designation_id',
        'institution_id',
        'is_active',
        'created_by',
        'updated_by',
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
        'password' => 'hashed',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'first_name' => 'required|string|max:30',
        'last_name' => 'required|string|max:30',
        'email' => 'required|email|unique:users',
        'designation_id' => 'required',
        'role' => 'required',
        'institution_id' => 'required'
    ];

    public function getfullNameAttribute()
    {
        return ucwords(strtolower($this->first_name) . " " . strtolower($this->middle_name) . " " . strtolower($this->last_name));
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

   public function designation(): BelongsTo
   {
       return $this->belongsTo(Designation::class);
   }

   public function department(): Model|null
   {
       if (empty($this->designation))
           return null;
       return $this->designation->department;
   }
}
