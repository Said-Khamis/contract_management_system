<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeDesignation extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'employee_designations';


    protected array $dates = ['deleted_at'];



    public $fillable = [
        'employee_id',
        'designation_id',
        'active',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'employee_id' => 'integer',
        'designation_id' => 'integer',
        'active' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'employee_id' => 'required',
        'designation_id' => 'required',
    ];

    /**
     * @return HasMany
     **/
    public function employees() : HasMany
    {
        return $this->hasMany(Employee::class, 'employee_id');
    }

    /**
     * @return HasMany
     **/
    public function designations() : HasMany
    {
        return $this->hasMany(Designation::class, 'designation_id');
    }
}
