<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaseModel extends Model
{
    // Define the fields to be guarded (if necessary)
    protected $guarded = [];

    // Define the boot method to register the listener
    protected static function boot(): void
    {
        parent::boot();

        // Define the "creating" event listener
        static::creating(function ($model) {
            $user = auth()->user() ? auth()->user():User::first();
            $model->created_by = $user ? $user->id:1;
            $model->updated_by = $user ? $user->id:1;
        });

        // Define the "updating" event listener
        static::updating(function ($model) {
            $user = auth()->user() ? auth()->user():User::first();
            $model->updated_by = $user ? $user->id:1;
        });
    }

    public function updatedBy() : BelongsTo|string
    {
        return $this->BelongsTo(User::class, 'updated_by');
    }

    /**
     * @return BelongsTo
     **/
    public function createdBy() : BelongsTo
    {
        return $this->BelongsTo(User::class, 'created_by');
    }

    public function isUpdated(): bool
    {
        return $this->updated_at > $this->created_at;
    }
}

