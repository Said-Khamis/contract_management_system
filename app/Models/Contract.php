<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Contract",
 *      required={"title", "reference_no", "duration"},
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
 *          property="title",
 *          description="title",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="reference_no",
 *          description="reference_no",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="signed_at",
 *          description="date_signed",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="signed_place",
 *          description="signed_place",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="ratification_at",
 *          description="ratification_date",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="duration",
 *          description="duration",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="amended",
 *          description="is_amended",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="start_date",
 *          description="start_date",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="end_date",
 *          description="end_date",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string",
 *          format="date-time"
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
 *      )
 * )
 */
class Contract extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contracts';

    protected array $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'reference_no',
        'signed_at',
        'auto_renewal',
        'signed_place',
        'ratified_at',
        'duration',
        'amended',
        'category_id',
        'start_date',
        'end_date',
        'created_by',
        'updated_by',
        'type'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'reference_no' => 'string',
        'signed_at' => 'datetime',
        'signed_place' => 'integer',
        'ratification_at' => 'datetime',
        'duration' => 'integer',
        'amended' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'end_date' => [
            'nullable',
            'after:start_date',
            'different:start_date',
        ],
        'signed_at' => [
            'nullable',
//            'before:end_date',
            'different:end_date',
        ],
        'start_date' => 'nullable',
        'title' => 'required',
        'reference_no' => 'nullable',
        'duration' => 'nullable|int',
        'type' => 'required',
        'category_id' => 'nullable'
    ];

    public function statuses(): HasMany {
        return $this->hasMany(ImplementationStatus::class,"implementable_id");
    }

    public function signedLocation(): MorphOne {
        return $this->morphOne(Location::class,'locationable');
    }

    public function actionPlans(): HasMany
    {
        return $this->hasMany(ActionPlan::class);
    }

    public function contractNotices(): HasMany
    {
        return $this->hasMany(ContractNotice::class);
    }

    public function contractObjectives(): HasMany
    {
        return $this->hasMany(ContractObjective::class);
    }

    public function contractOperationAreas(): HasMany
    {
        return $this->hasMany(ContractOperationArea::class);
    }
    public function contractDelivery(): HasMany
    {
        return $this->hasMany(ContractDeliveryTimeline::class);
    }

    public function contractParties(): HasMany
    {
        return $this->hasMany(ContractParty::class);
    }

    public function contractResponsibilities(): HasMany
    {
        return $this->hasMany(ContractResponsibility::class);
    }

    public function getSignedAddress(){

    }

    public function getSignedSettlement(){
        return $this->signedLocation->settlement ?? null;
    }

    public function ratified(): bool
    {
        return $this->ratified_at != null;
    }
    public function signed(): bool
    {
        return $this->signed_at != null;
    }

    public function attachments() : MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function internalProcedure(): MorphMany
    {
        return $this->morphMany(InternalProcedure::class, 'procedurable');
    }

    public function currentOffice(){
        return $this->morphMany(InternalProcedure::class, 'procedurable')->latest()->first()->toInstitution->name ??
        $this->morphMany(InternalProcedure::class, 'procedurable')->latest()->first()->fromInstitution->name;
    }

    public function status(): HasMany {
        return $this->hasMany(ImplementationStatus::class,"contract_id");
    }

    public function implementable(): hasMany {
        return $this->hasMany(ImplementationStatus::class,"implementable_id");
    }

    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class,"created_by");
    }

    public function updatedByUser(): BelongsTo|string
    {
        return $this->belongsTo(User::class,"");
    }
}
