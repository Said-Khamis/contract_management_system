<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\PermissionRegistrar;

class Role extends SpatieRole
{
    use HasFactory;

    public $fillable = ['name', 'guard_name', 'institution_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'guard_name' => 'string',
        'institution_id' => 'integer'
    ];

    public function __construct(array $attributes = [])
    {
        if(isset($attributes['institution_id'])) {
            static::checkInstitutionExists($attributes['institution_id']);
        }

        parent::__construct($attributes);
    }

    public static function create(array $attributes = []): Model|Builder
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        $params = ['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']];

        if(isset($attributes['institution_id']))
            $params['institution_id'] = $attributes['institution_id'];

        if (PermissionRegistrar::$teams) {
            if (array_key_exists(PermissionRegistrar::$teamsKey, $attributes)) {
                $params[PermissionRegistrar::$teamsKey] = $attributes[PermissionRegistrar::$teamsKey];
            } else {
                $attributes[PermissionRegistrar::$teamsKey] = getPermissionsTeamId();
            }
        }

        if(isset($attributes['institution_id'])) {
            static::checkInstitutionExists($attributes['institution_id']);
        }

        if (static::findByParam($params)) {
            throw RoleAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }

    protected static function findByParam(array $params = []): Model|Builder|null
    {
        $query = static::query();

        if (PermissionRegistrar::$teams) {
            $query->where(function ($q) use ($params) {
                $q->whereNull(PermissionRegistrar::$teamsKey)
                    ->orWhere(PermissionRegistrar::$teamsKey, $params[PermissionRegistrar::$teamsKey] ?? getPermissionsTeamId());
            });
            unset($params[PermissionRegistrar::$teamsKey]);
        }

        foreach ($params as $key => $value) {
            if(!is_null($value)) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    private static function checkInstitutionExists(int $id): void
    {
        $institution = Institution::find($id);

        if(empty($institution)) {
            throw new ModelNotFoundException("Institution does not exist" );
        }
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
