<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryService
{

    public function __construct(protected CategoryRepository $categoryRepository){}

    /**
     * creating new category
     * @param array $input new category input details to create category in category table
     * @return Model
     * @throws Throwable
     */
    public function createCategory(array $input): Model
    {
        return DB::transaction(function() use ($input) {
            if(isset($input['category_id'])) {
                $category = $this->getCategory($input['category_id']);
                return $this->categoryRepository->createWithRelation($input, $category, 'categories');
            }
            else {
                return $this->categoryRepository->create($input);
            }
        });
    }


    /**
     * Fetch list of all category in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll() : LengthAwarePaginator
    {
        return $this->categoryRepository->paginate(10);
    }

    /**
     * fetch one  category by its id
     * @param int $id id of primary key of a single category
     * @return Model|null a category instance of a model
     */
    public function getCategory(int $id): Model|null
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * Update category details
     * @param array $input new category input details to edit from category
     * @param int $id id of primary key of a category object we need to update
     * @return Model
     * @throws Throwable
     */
    public function updateCategory(array $input, int $id): Model
    {
        return DB::transaction(function() use ($input, $id) {
            return $this->categoryRepository->update($input,$id);
        });
    }

    /**
     * delete a category from a database category table
     * @throws Exception
     * @throws Throwable
     */
    public function deleteCategory(int $id)
    {
        return DB::transaction(function() use ($id) {
            return $this->categoryRepository->delete($id);
        });
    }
}
