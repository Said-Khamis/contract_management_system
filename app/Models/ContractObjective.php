<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

/**
 * @OA\Schema(
 *      schema="ContractObjective",
 *      required={"details", "contract_id"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="created_at",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="details",
 *          description="details",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="contract_id",
 *          description="contract_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="created_by",
 *          description="created_by",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="updated_by",
 *          description="updated_by",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="contract_objective_id",
 *          description="contract_objective_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class ContractObjective extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contract_objectives';


    protected array $dates = ['deleted_at'];



    public $fillable = [
        'details',
//        'contract_id',
        'created_by',
        'updated_by',
        'contract_objective_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contract_id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'contract_objective_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'details' => 'required',
//        'contract_id' => 'required'
//        'contract_objective_id' => 'required'

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Contract::class, 'contract_id');
    }

    /**
     * @return HasMany
     **/
    public function contractObjectives(): HasMany
    {
        return $this->hasMany(ContractObjective::class, 'contract_objective_id');
    }

    public static function boot(): void
    {
        parent::boot();

        static::deleting(function ($parent) {

            foreach ($parent->contractObjectives as $child)
            {
                $child->delete();
            }
        });
    }

    public function statuses(): MorphMany{
        return $this->morphMany(ImplementationStatus::class, 'implementable');
    }
}
