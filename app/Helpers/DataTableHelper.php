<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class DataTableHelper
{
    public static function renderContractsDatatable($contracts): JsonResponse
    {
        return DataTables::of($contracts)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                return '<div class="btn-group">
                        <a class="btn btn-outline-success btn-sm" href="' . route('contractss.edit', [encode($row->id)]) . '"><i class="ri-pencil-fill"></i></a>
                        <a title="More details" href="' . route('contractss.show', [encode($row->id)]) . '" class="btn btn-outline-primary btn-sm"><i class="ri-eye-fill"></i></a>
                        <a title="Delete" href="' . route('contractss.delete', [encode($row->id)]) . '" class="btn btn-outline-danger btn-sm" data-confirm-delete="true"><i class="ri-delete-bin-fill"></i></a>
                    </div>';
            })
            ->addColumn('title', function($row) {
                return '<span data-bs-toggle="tooltip" data-bs-placement="top" title="'.ucwords(strtolower($row->title)).'">'.Str::words( ucwords(strtolower($row->title)), 3,"...").'</span>';
            })
            ->addColumn('register_no', function($row) {
                return '<span class="badge rounded-pill badge-soft-success">'.$row->reference_no.'</span>';
            })
            ->addColumn('date_signed', function($row) {
                $dateSinged='N/A';
                if ($row->signed_at)
                {
                    $dateSinged=date('d M, Y', strtotime($row->signed_at));
                }
                return $dateSinged;
            })
            ->addColumn('signing_place', function($row) {
                return  getSignedSettlement($row->id);
            })
            ->addColumn('ratification_date', function($row) {
                $ratificationDate='N/A';
                if($row->ratified_at) {
                    $ratificationDate=date('d M, Y', strtotime($row->ratified_at));
                }
                return $ratificationDate;
            })
            ->addColumn('duration', function($row) {
                return $row->duration ??  'N/A';
            })
            ->addColumn('amendment', function($row) {
                return $row->is_amended ? 'Yes' : 'No';
            })
            ->addColumn('start_date', function($row) {
                return isset($row->start_date) ? date('d M, Y', strtotime($row->start_date)) : 'N/A';
            })
            ->addColumn('end_date', function($row) {
                return isset($row->end_date) ? date('d M, Y', strtotime($row->end_date)) : 'N/A' ;
            })
            ->addColumn('status', function($row) {
                if($row->signed_at)
                {
                    return '<span class="badge rounded-pill text-bg-success">'.'Signed'.'</span>';
                }else
                {
                    return '<span class="badge rounded-pill text-bg-warning">'.'Draft'.'</span>';
                }
            })
            ->rawColumns(['title','status','ratification_date','duration','start_date',
                'end_date','amendment','signing_place','date_signed','register_no','action'])
            ->make(true);
    }

    /**
     * @throws Exception
     */
    public static function renderUserDataTable($users): JsonResponse
    {
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-success btn-sm data-modal" data-url="' . route('user.show', [encode($row->id)]) . '"><i class="ri-eye-fill"></i></button>
                            <a class="btn btn-soft-secondary btn-sm" href="' . route('user.edit', [encode($row->id)]) . '"><i class="ri-pencil-fill"></i></a>
                            <a class="btn ' . userCurrentStatus($row->is_active, "btn-soft-danger", "btn-soft-success")  . ' btn-sm" href="' . route('user.status', [encode($row->id)]) . '" data-bs-toggle="tooltip" data-bs-placement="left" title="' . userCurrentStatus($row->is_active, "Block User", "UnBlock")  . '"><i class="' . userCurrentStatus($row->is_active, "ri-close-circle-fill", "ri-check-fill")  . '"></i></a>
                        </div>';
            })
            ->addColumn('name', function ($row) {
                return isset($row->middle_name) ? ucfirst($row->first_name) . " " .  ucfirst($row->middle_name) . " " . ucfirst($row->last_name) : ucfirst($row->first_name) . " " . ucfirst($row->last_name);
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('institution', function ($row) {
                return $row->institution->abbreviation;
            })
            ->addColumn('role', function ($row) {
                return $row->roles()->first()->name == 'super-admin' || $row->roles()->first()->name == 'admin' ? '<span class="badge bg-opacity-75 bg-primary">'. $row->roles()->first()->name . '</span>' : '<span class="badge bg-opacity-50 bg-info text-dark">' . $row->roles()->first()->name . '</span>';
            })
            ->addColumn('status', function ($row) {
                return $row->is_active ? '<span class="badge bg-opacity-75 bg-success">ACTIVE</span>' : '<span class="badge bg-opacity-75 bg-danger">INACTIVE</span>';
            })
            ->addColumn('designation', function ($row) {
                return !is_null($row->designation) ? $row->designation->title : "";
            })
            ->addColumn('department', function ($row) {
                return !is_null($row->department()) ? $row->department()->code : "";
            })
            ->rawColumns(['#', 'name', 'email', 'role', 'institution', 'status', 'designation', 'department', 'actions'])
            ->make(true);
    }

    /**
     * @throws Exception
     */
    public static function renderRoleDataTable($roles): JsonResponse
    {
        return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-success btn-sm data-modal" data-url="' . route('role.show', encode($row->id)) . '"><i class="ri-eye-fill"></i></button>
                            <a class="btn btn-soft-secondary btn-sm" href="' . route('role.edit', encode($row->id)) . '"><i class="ri-pencil-fill"></i></a>
                            <button type="button" class="btn btn-soft-danger btn-sm"><i class="ri-delete-bin-2-fill"></i></button>
                        </div>';
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->rawColumns(['#', 'name', 'actions'])
            ->make(true);
    }

    public static function renderPermissionDataTable($permissions): JsonResponse
    {
        return DataTables::of($permissions)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('group', function ($row) {
                return $row->group;
            })
            ->rawColumns(['#', 'name', 'group'])
            ->make(true);
    }

    public static function renderInstitutionDataTable($institutions): JsonResponse
    {
        return DataTables::of($institutions)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm institution-show" data-id="'.$row->id.'" data-endpoint="' . route('institutions.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm  institution-edit" data-id="'.$row->id.'" data-endpoint="' . route('institutions.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill institution-delete" data-id="'.$row->id.'"></i></button>
                      </div>';
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('abbreviation', function ($row) {
                return $row->abbreviation;
            })
            ->rawColumns(['#', 'name', 'abbreviation', 'actions'])
            ->make(true);
    }

    public static function renderSectorDataTable($sector): JsonResponse
    {
        return DataTables::of($sector)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm sectors-show" data-id="'.$row->id.'" data-endpoint="' . route('sectors.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm sectors-edit" data-id="'.$row->id.'" data-endpoint="' . route('sectors.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill sectors-delete" data-id="'.$row->id.'"></i></button>
                      </div>';
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('description', function ($row) {
                return $row->description;
            })
            ->rawColumns(['#', 'name', 'description', 'actions'])
            ->make(true);
    }


    public static function renderSubTypeDataTable($subtype): JsonResponse
    {
        return DataTables::of($subtype)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm subtype-show" data-id="'.$row->id.'" data-endpoint="' . route('contract_subtypes.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm subtype-edit" data-id="'.$row->id.'" data-endpoint="' . route('contract_subtypes.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill subtype-delete" data-id="'.$row->id.'"></i></button>
                      </div>';
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('description', function ($row) {
                return $row->description;
            })
            ->rawColumns(['#', 'name', 'description', 'actions'])
            ->make(true);
    }

    public static function renderCountryDataTable($countries): JsonResponse
    {
        return DataTables::of($countries)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('countries.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('countries.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                             <a type="button" href="'.route('countries.delete',[$row->id]).'" data-confirm-delete="true" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill"></i></a>
                        </div>';
            })
            ->addColumn('name', function ($row) {
                return ucwords($row->name);
            })
            ->addColumn('code', function ($row) {
                return strtoupper($row->code);
            })
            ->rawColumns(['#', 'name', 'code', 'actions'])
            ->make(true);
    }

    public static function renderStateDataTable($states): JsonResponse
    {
        return DataTables::of($states)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('states.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('states.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <a type="button" href="'.route('states.delete',[$row->id]).'" data-confirm-delete="true" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill"></i></a>
                        </div>';
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('country', function ($row) {
                return $row->country->name;
            })
            ->rawColumns(['#', 'name', 'country', 'actions'])
            ->make(true);
    }

    public static function renderDepartmentDataTable($departments): JsonResponse
    {
        return DataTables::of($departments)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm depart-show"  data-id="'.$row->id.'" data-endpoint="' . route('departments.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm depart-edit" data-id="'.$row->id.'" data-endpoint="' . route('departments.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <button type="button" class="btn btn-danger btn-sm depart-delete" data-id="'.$row->id.'"><i class="ri-delete-bin-2-fill"></i></button>
                        </div>';
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('code', function ($row) {
                return $row->code;
            })
            ->addColumn('institution', function ($row) {
                return $row->institution->abbreviation;
            })
            ->addColumn('description', function ($row) {
                return $row->description;
            })
            ->rawColumns(['#', 'name','code','institution','description','actions'])
            ->make(true);
    }

    public static function renderDesignationDataTable($designations): JsonResponse
    {
        return DataTables::of($designations)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm design-show" data-id="'.$row->id.'" data-endpoint="' . route('designations.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm design-edit" data-id="'.$row->id.'"  data-endpoint="' . route('designations.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <button type="button" class="btn btn-danger btn-sm design-delete" data-id="'.$row->id.'"><i class="ri-delete-bin-2-fill"></i></button>
                        </div>';
            })
            ->addColumn('title', function ($row) {
                return $row->title;
            })
            ->addColumn('description', function ($row) {
                return $row->description;
            })
            ->addColumn('institution', function ($row) {
                return $row->institution->abbreviation;
            })
            ->rawColumns(['#', 'title','description','institution','actions'])
            ->make(true);
    }

}

