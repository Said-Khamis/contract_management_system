<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;

    public $fillable = ['name', 'guard_name', 'group'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'guard_name' => 'string',
        'group' => 'string'
    ];

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        $permission = static::getPermission(['name' => $attributes['name'],'guard_name' => $attributes['guard_name'], 'group' => $attributes['group']]);

        if ($permission) {
            throw PermissionAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }


    /**
     * Find Permissions by Group
     *
     * @param string $group
     * @param null $guardName
     * @return Collection
     */
    public static function findByGroup(string $group, $guardName = null): Collection
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);
        return static::getPermissions(['group' => $group, 'guard_name' => $guardName]);
    }
}
