<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use Exception;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class CategoryController extends AppBaseController
{
    public function __construct(protected CategoryService $categoryService){}

    /**
     * Display a listing of the Category.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $categories = $this->categoryService->findAll();

        $title = 'Deleting Category!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $input = $request->all();

        $this->categoryService->createCategory($input);

        toast('Category saved successfully.','success');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function show(int $id): View|RedirectResponse
    {
        $category = $this->categoryService->getCategory($id);

        if (empty($category)) {
            alert()->error('Model not found','Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('category', $category);
    }

    /**
     * Generate show fields of the specified Category.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function showFields(int $id): View|RedirectResponse
    {
        $category = $this->categoryService->getCategory($id);

        if (empty($category)) {
            alert()->error('Model not found','Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show_fields')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function edit(int $id) : View|RedirectResponse
    {
        $category = $this->categoryService->getCategory($id);

        if (empty($category)) {
            alert()->error('Model not found','Category not found');;

            return redirect(route('categories.index'));
        }


        return view('categories.edit')->with('category', $category);
    }

    /**
     * Show the edit fields for editing the specified Category.
     *
     * @param int $id
     *
     * @return View|RedirectResponse
     */
    public function editFields(int $id) : View|RedirectResponse
    {
        $category = $this->categoryService->getCategory($id);

        if (empty($category)) {
            alert()->error('Model not found','Category not found');;

            return redirect(route('categories.index'));
        }

        return view('categories.edit_fields')->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param int $id
     * @param UpdateCategoryRequest $request
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, Request $request) : RedirectResponse
    {
        $category = $this->categoryService->getCategory($id);

        if (empty($category)) {
            alert()->error('Model not found','Category not found');;

            return redirect(route('categories.index'));
        }

        $this->categoryService->updateCategory($request->all(), $id);

        toast('Category updated successfully.','success');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Throwable
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = $this->categoryService->getCategory($id);

        if (empty($category)) {
            alert()->error('Model not found','Category not found');;

            return redirect(route('categories.index'));
        }

        $this->categoryService->deleteCategory($id);

        toast('Category deleted successfully.','success');

        return redirect(route('categories.index'));
    }
}
