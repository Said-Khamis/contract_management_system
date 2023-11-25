<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ContractTermination extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contract_terminations';


    protected array $dates = ['deleted_at'];



    public $fillable = [
        'date_of_termination',
        'reasons',
        'attachment_id',
        'created_by',
        'updated_by',
        'contract_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts= [
        'id' => 'integer',
        'date_of_termination' => 'date',
        'attachment_id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'contract_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'date_of_termination' => 'date',
        'created_at' => 'nullable|nullable|nullable',
        'updated_at' => 'nullable|nullable|nullable',
        'deleted_at' => 'nullable|nullable|nullable'
    ];

    /**
     * @return HasOne
     **/
    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class, 'contract_id');
    }

    /**
     *
     **/
    public function attachments() //: HasMany
    {
        //return $this->hasMany(Attachment::class, 'attachment_id'); // Morphing implementation pending
    }
}
