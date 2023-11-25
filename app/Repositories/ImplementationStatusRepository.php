<?php

namespace App\Repositories;

use App\Models\ImplementationStatus;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class ImplementationStatusRepository
 * @package App\Repositories
 * @version October 17, 2023, 3:44 pm UTC
*/

class ImplementationStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'contract_id',
        'comment',
        'percent',
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
    public function model(): string {
        return ImplementationStatus::class;
    }

    /**
     * @return Collection
     */
    public function topFivePerformance(): Collection
    {
        return ImplementationStatus::select(DB::raw("contract_id, reference_no, title, avg(percent) as average"))
            ->join('contractss', 'contract_id', 'contractss.id')
            ->groupBy('contract_id')
            ->orderByDesc('average')
            ->take(5)
            ->get();
    }
}
