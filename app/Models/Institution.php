<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Institution
 * @package App\Models
 * @version June 7, 2023, 12:59 pm UTC
 *
 * @property Collection $institutions
 * @property string $name
 * @property string $abbreviation
 * @property boolean $is_local
 * @property boolean $is_sector
 * @property integer $institution_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property mixed rules
 */
class Institution extends BaseModel
{
    //use SoftDeletes;
    use HasFactory;

    public $table = 'institutions';

    protected array $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'abbreviation',
        'institution_id',
        'is_local',
        'is_sector',
        'created_by',
        'updated_by',
        'institution_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'abbreviation' => 'string',
        'institution_id' => 'integer',
        'is_local' => 'boolean',
        'is_sector' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'name' => 'required|string|unique:institutions,name',
        'abbreviation' => 'required|unique:institutions,abbreviation',
        'is_local' => 'nullable|boolean',
        'is_sector' => 'nullable|boolean',
        'institution_id' => 'nullable',
    ];

    /**
     * @return HasOne
     **/
    public function parent() : belongsTo {
        return $this->belongsTo(Institution::class, 'institution_id');
    }


     /** Get the location record associated with the institute.
     *
     * @return MorphOne
     */
    public function location(): MorphOne {
        return $this->morphOne(Location::class, 'locationable');
    }

    /**
     * @return BelongsTo
     **/
    public function sector(): BelongsTo {
        return $this->belongsTo(Sector::class);
    }

    /**
     * @return HasMany
     **/
    public function contractParties(): HasMany {
        return $this->hasMany(ContractParty::class);
    }

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function updatedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function roles(): HasMany {
        return $this->hasMany(Role::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class,"institution_id");
    }

    public function designations(): HasMany
    {
        return $this->hasMany(Designation::class,"institution_id");
    }
}

