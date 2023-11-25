<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ActionPlan
 * @package App\Models
 * @version June 7, 2023, 1:36 pm UTC
 *
 * @property Collection $contractss
 * @property string $action_plan
 * @property integer $contract_id
 * @property integer $created_by
 * @property integer $updated_by
 */
class ActionPlan extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'action_plans';

    protected array $dates = ['deleted_at'];



    public $fillable = [
        'contract_id',
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
        'contract_id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'contract_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return BelongsTo
     **/
    public function contract() : BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function attachments() : MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
