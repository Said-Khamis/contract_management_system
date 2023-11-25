<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Institution;
use App\Models\ProcedureComment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="InternalProcedure",
 *      required={"procedurable_type", "procedurable_id", "from_institution_id", "status", "created_by", "updated_by"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="procedurable_type",
 *          description="procedurable_type",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="procedurable_id",
 *          description="procedurable_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="from_institution_id",
 *          description="from_institution_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="to_institution_id",
 *          description="to_institution_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="status",
 *          description="status",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
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
 *          property="deleted_at",
 *          description="deleted_at",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class InternalProcedure extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'internal_procedures';
    
    protected $dates = ['deleted_at'];



    public $fillable = [
        'procedurable_type',
        'procedurable_id',
        'from_institution_id',
        'to_institution_id',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'procedurable_type' => 'string',
        'procedurable_id' => 'integer',
        'from_institution_id' => 'integer',
        'to_institution_id' => 'integer',
        'status' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'procedurable_type' => 'required|string|max:255',
        'procedurable_id' => 'required',
        'from_institution_id' => 'required',
        'to_institution_id' => 'nullable',
        'status' => 'required|string',
        'created_by' => 'required',
        'updated_by' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function procedurable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fromInstitution()
    {
        return $this->belongsTo(Institution::class, 'from_institution_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function toInstitution()
    {
        return $this->belongsTo(Institution::class, 'to_institution_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function procedureComments()
    {
        return $this->hasMany(ProcedureComment::class, 'internal_procedure_id')->orderBy('created_at','desc');
    }


    /**
     * @return BelongsTo
     **/
    public function createdBy() : BelongsTo
    {
        return $this->BelongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     **/
    public function updatedBy() : BelongsTo
    {
        return $this->BelongsTo(User::class, 'updated_by');
    }

}