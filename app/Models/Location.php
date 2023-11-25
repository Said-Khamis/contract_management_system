<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="Location",
 *      required={"settlement"},
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
 *          property="settlement",
 *          description="settlement",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="ward_id",
 *          description="ward_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="district_id",
 *          description="district_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="city_id",
 *          description="city_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="region_id",
 *          description="region_id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="state_id",
 *          description="state_id",
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
 *      )
 * )
 */
class Location extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'locations';

    protected array $dates = ['deleted_at'];

    public $fillable = [
        'settlement',
        'country_id',
        'ward_id',
        'district_id',
        'city_id',
        'region_id',
        'state_id',
        'created_by',
        'updated_by',
        'locationable_type',
        'locationable_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'settlement' => 'string',
        'ward_id' => 'integer',
        'district_id' => 'integer',
        'city_id' => 'integer',
        'region_id' => 'integer',
        'state_id' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'settlement' => 'required'
    ];


    /**
     * @return MorphTo
     */
    public function locationable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     **/
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsTo
     **/
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * @return BelongsTo
     **/
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @return BelongsTo
     **/
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }


    /**
     * @return BelongsTo
     **/
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }


    /**
     * @return BelongsTo
     **/
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function getSignedFullLocation(){

        $this->getCountry();
        $region = null;

        $this->getRegion();

        $district = null;
        if($this->signedLocation->district_id){
            $district = $this->signedLocation->district->name;
        }
        $this->getDistrict();

        $state = null;
        if($this->signedLocation->state_id){
            $state = $this->signedLocation->state->name;
        }

        $this->getState();

        $city = null;
        if($this->signedLocation->city_id){
            $city = $this->signedLocation->city->name;
        }

        $this->getCity();

    }

    private function getCountry()
    {
       return $this->country->name;
    }

    private function getRegion()
    {
        if($this->region_id){
            return $this->region->name;
        }
    }

    private function getDistrict()
    {
    }

    private function getState()
    {
    }

    private function getCity()
    {
    }
}
