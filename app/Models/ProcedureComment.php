<?php

namespace App\Models;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="ProcedureComment",
 *      required={"internal_procedure_id", "from_user_id", "comment", "created_by", "updated_by"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="internal_procedure_id",
 *          description="internal_procedure_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="from_user_id",
 *          description="from_user_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="to_user_id",
 *          description="to_user_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="comment",
 *          description="comment",
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
class ProcedureComment extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'procedure_comments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'internal_procedure_id',
        'from_user_id',
        'to_user_id',
        'comment',
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
        'internal_procedure_id' => 'integer',
        'from_user_id' => 'integer',
        'to_user_id' => 'integer',
        'comment' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'internal_procedure_id' => 'required',
        'from_user_id' => 'required',
        'to_user_id' => 'nullable',
        'comment' => 'required|string',
        'created_by' => 'required',
        'updated_by' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function fromUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'from_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function internalProcedure()
    {
        return $this->belongsTo(\App\Models\InternalProcedure::class, 'internal_procedure_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function toUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'to_user_id');
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


    public function attachment(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}