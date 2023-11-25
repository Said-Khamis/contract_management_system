<?php

namespace App\Repositories;

use App\Models\Contract;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Collection;

/**
 * Class ContractRepository
 * @package App\Repositories
 * @version June 3, 2023, 1:16 pm UTC
*/

class ContractRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'title',
        'reference_no',
        'date_signed',
        'signed_place',
        'ratification_date',
        'duration',
        'is_amended',
        'start_date',
        'end_date',
        'created_by',
        'updated_by'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Contract::class;
    }

    public function findAllContracts(): \Illuminate\Database\Eloquent\Collection{
        return Contract::with("createdBy")->latest()->get();
    }

    public function recent(): \Illuminate\Database\Eloquent\Collection {
        return Contract::with('signedLocation')
            ->whereNotNull('signed_at')
            ->orderByDesc('reference_no')
            ->take(5)
            ->get();
    }

    public function count(int $category, bool $signed=false): int {
        $builder = DB::table('contracts')
            ->where('category_id', $category);
        if ($signed) {
            return $builder->whereNotNull('signed_at')->count();
        } else {
            return $builder->whereNull('signed_at')->count();
        }
    }

    public function countByType(string $type, bool $signed = false): string
    {
        $builder = DB::table('contracts')
            ->where('type', $type);
        if ($signed) {
            return $builder->whereNotNull('signed_at')->count();
        } else {
            return $builder->whereNull('signed_at')->count();
        }
    }
}
