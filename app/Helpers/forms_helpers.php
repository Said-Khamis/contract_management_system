<?php /** @noinspection ALL */

use App\Models\City;
use App\Models\Country;
use App\Models\Institution;
use App\Models\Region;
use App\Models\State;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\User;

function validateInput($errors, $input, $value = null){
    if($errors->has($input)){
        return "is-invalid";
    }
    elseif (!$errors->has($input) && !empty($value)){
        return "is-valid";
    }
}

function getPluckedCategory(){
    return \App\Models\Category::pluck('name', 'id');
}

function getPluckedWard($districtId = null){
    if($districtId)
        return \App\Models\Ward::where('district_id',$districtId)->pluck('name', 'id');
    else
        return \App\Models\Ward::pluck('name', 'id');
}

function getPluckedDistrict($regionId = null){
    if($regionId)
        return \App\Models\District::where('region_id',$regionId)->pluck('name', 'id');
    else
        return \App\Models\District::pluck('name', 'id');
}

function getPluckedRegion($countryId = null)
{
    if($countryId)
        return \App\Models\Region::where('country_id',$countryId)->pluck('name', 'id');
    else
        return \App\Models\Region::pluck('name', 'id');
}

function getPluckedState($countryId = null)
{
    if($countryId)
        return \App\Models\State::where('country_id',$countryId)->pluck('name', 'id');
    else
        return \App\Models\State::pluck('name', 'id');
}

function getPluckedCity($countryId = null)
{
    if($countryId)
        return \App\Models\City::where('country_id',$countryId)->pluck('name', 'id');
    else
        return \App\Models\City::pluck('name', 'id');
}

function getPluckedCountry()
{
    return \App\Models\Country::pluck('name', 'id');
}

function getPluckedCountryWithState()
{
    return \App\Models\Country::where('hasState',1)->pluck('name', 'id');
}

function getPluckedCountryWithCity()
{
    return \App\Models\Country::where('hasCity',1)->pluck('name', 'id');
}

function getPluckedCountryWithRegion()
{
    return \App\Models\Country::where('hasRegion',1)->pluck('name', 'id');
}

function getContractSubType(){
    return \App\Models\ContractSubtype::get();
}

function getPluckedLocation($countryId = null)
{
    $locations = Country::find($countryId);
    if ($locations !== null) {

        if ($locations->hasCity == 1) {
            return $locations = City::where('country_id', $countryId)->pluck('name', 'id');
        }
        if ($locations->hasState == 1) {
            return $locations = State::where('country_id', $countryId)->pluck('name', 'id');
        }
        if ($locations->hasRegion == 1) {
            return $locations = Region::where('country_id', $countryId)->pluck('name', 'id');
        }
    }

//        if($countryId)
//        return \App\Models\Region::where('country_id',$countryId)->pluck('name', 'id');
//    else
//        return \App\Models\Region::pluck('name', 'id');
}
function getSignedSettlement($contractID){
    $contract=\App\Models\Contract::find($contractID);
    $location= $contract->signedLocation;
    if($location)
    {
        $locationName='';
        if ($location->region_id !==null){
            $locationName=  $location->region->name;
        }else if($location->state_id !==null){
            $locationName=  $location->state->name;
        }else if($location->city_id !==null){
            $locationName=  $location->city->name;
        }
        return $locationName;
    }else
    {
        return "N/A";
    }
}
function getPluckedDesignations($institutionId = null)
{
    if($institutionId)
        return \App\Models\Designation::where('institution_id', $institutionId)
            ->orWhereNull('institution_id')
            ->orderBy('title')
            ->pluck('title', 'id');
    return \App\Models\Designation::pluck('title', 'id');
}

function getPluckedDepartments($institutionId = null)
{
    if($institutionId)
        return \App\Models\Department::where('institution_id', $institutionId)
            ->orWhereNull('institution_id')
            ->orderBy('name')
            ->pluck('name','id');
    return \App\Models\Department::pluck('name', 'id');
}

function getPluckedApprovalGroups(){
    return \App\Models\Approval\ApprovalGroup::pluck('name','id');
}

function approvalWorkFlowTypeCheckList(){
    return array_values(config('data.approval_work_flow_types'))[0];
}

function approvalWorkFlowTypeJobCard(){
    return array_values(config('data.approval_work_flow_types'))[1];
}

function approvalWorkFlowTypeRequisition(){
    return array_values(config('data.approval_work_flow_types'))[2];
}

function approvalWorkFlowTypePurchaseOrder(){
    return array_values(config('data.approval_work_flow_types'))[3];
}

function approvalWorkFlows(){
    return config('data.approval_work_flow_types');
}

function getRoles(){
    return \Spatie\Permission\Models\Role::pluck('name','id');
}

function getPluckedInstitutions(){
    return \App\Models\Institution::whereNot('id', 1)->pluck('name','id');
}

function getPluckedInstitutionsRolesBased(){
    $userRole = auth()->user()->roles;
    $institutionId = auth()->user()->institution->id;
    if($userRole[0]->name === "super-admin"){
        return \App\Models\Institution::pluck('name','id');
    }
    return \App\Models\Institution::whereNot('id', 1)->where("id",$institutionId)->pluck('name','id');
}

function getPluckedDepartmentsRolesBased(){
    return \App\Models\Department::pluck('name', 'id');
}

function getUnPluckedInstitutions(){
    return \App\Models\Institution::whereNot('id', 1)
        ->select("id","name")
        ->get();
}

function getContractObjectives($contractId){
    return \App\Models\ContractObjective::where('contract_id',$contractId)
        ->pluck('details','id');
}

function getContractOperationAreas($contractId){
    return \App\Models\ContractOperationArea::where('contract_id',$contractId)
        ->pluck('area','id');
}

function getPluckedContractParty($contractId) {
    return \App\Models\ContractParty::select('contract_parties.id','institutions.name as institution')
        ->join('institutions','institutions.id','=','contract_parties.institution_id')
        ->where('contract_parties.contract_id',$contractId)->pluck('institution','contract_parties.id');
}

function dateAdded($model){
    return date('M d, Y H:i', strtotime($model->created_at)).($model->createdBy !==null ? ', By '.$model->createdBy->email : '');
}

function lastModified($model){
    if($model->created_at != $model->updated_at){
        return date('M d, Y H:i', strtotime($model->updated_at)).($model->updatedBy !==null ? ', By '.$model->updatedBy->email : '');
    }
    return 'N/A';
}

function getPluckedStates(){
    return \App\Models\State::pluck('name','id');
}


// Define a function to get plucked institutions where is_local is 1
function getHomePartiesPluckednstitutions()
{
    return App\Models\Institution::where('is_local', 1)->orderBy('name','ASC')->pluck('name', 'id');
}

function getForeignPartiesPluckedInstitutions()
{
    return App\Models\Institution::where('is_local', 0)->orderBy('name','ASC')->pluck('name', 'id');
}


function getContractAttachment($contractId)
{
    $searchTerms = ['letter_of_intent', 'instrument_of_ratification','passport_copy','agreement']; // Define the search terms
    return $attachments = \App\Models\Attachment::whereHasMorph('attachable', [\App\Models\Contract::class], function ($query) use ($contractId) {
        $query->where('attachable_id', $contractId);
    })->where(function ($query) use ($searchTerms) {
           foreach ($searchTerms as $term) {
               $query->orWhere('name', 'LIKE', '%' . $term . '%');
           }
    })->get();
}


function encode($hash)
{
    return Hashids::encode($hash);
}

function decode($hash)
{
    $decodedArray = Hashids::decode($hash);
    return count($decodedArray) > 0 ? $decodedArray[0] : null;
}



function getContractPartInstitutionIds($contract){
        $homeParts = [];
        $foreignParts = [];

        foreach ($contract->contractParties as $party) {
            $attributes = $party->getAttributes(); // Get all attributes as an array

            if ($attributes['is_local'] === 1) {
                $homeParts[] = $attributes['institution_id'];
            } else {
                $foreignParts[] = $attributes['institution_id'];
            }
        }

        $homePartInstitutionId = count($homeParts) > 0 ? $homeParts[0] : null;
        $foreignPartInstitutionId = count($foreignParts) > 0 ? $foreignParts[0] : null;

        return [
            'homePartInstitutionId' => $homePartInstitutionId,
            'foreignPartInstitutionId' => $foreignPartInstitutionId,
        ];
}

function userCurrentStatus(bool $status, string $valueIfTrue, string $valueIfFalse): string {
    return $status ? $valueIfTrue : $valueIfFalse;
}


function getUsersFromMyInstitution() {
    $users = User::where('institution_id', auth()->user()->institution_id)->where('id', '!=', auth()->user()->id)->get();
    $usersFromMyInstitution = [];
    foreach ($users as $user) {
        $usersFromMyInstitution[$user->id] = $user->fullName . getUserDesignation($user);
    }
    return $usersFromMyInstitution;
}

function getOtherInstitutions()
{
    $institutions = Institution::where('is_local', 1)->where('id', '!=', auth()->user()->institution_id)->where('name', 'not like', '%united republic of t%')->get();
    $otherInstitutions = [];
    foreach ($institutions as $institution) {
        if($institution->abbreviation){
            $otherInstitutions[$institution->id] = $institution->name.' ('.$institution->abbreviation.')';
        }else{
            $otherInstitutions[$institution->id] = $institution->name;
        }
    }
    return $otherInstitutions;
}


function getUserDesignation($user) {
    return !is_null($user->designation) ?
        !is_null($user->department()) ? ' (' . strtoupper($user->department()->code) .' - ' . ucwords($user->designation->description) . ')' : " (FMS" .' - ' .
        ucwords($user->designation->description) . ')' : '(FMS - Officer)';
}

function checkContractData($contract) {
    if($contract->contractParties && count($contract->contractSectors)>=1) {
        return true;
    }
    return false;
}

function checkInstitutionName($name, $id)
{
    if($id !== null){
        return response()->json([
            'valid' => true
        ]);
    }else{
        $user = Institution::where('name', $name)->first();
        if ($user) {
            return response()->json([
                'valid' => false
            ]);
        } else {
            return response()->json([
                'valid' => true
            ]);
        }
    }
}

function checkSectorName($name, $id)
{
    if($id !== null){
        return response()->json([
            'valid' => true
        ]);
    }else{
        $sector = \App\Models\Sector::where('name', $name)->first();
        if ($sector) {
            return response()->json([
                'valid' => false
            ]);
        } else {
            return response()->json([
                'valid' => true
            ]);
        }
    }
}
function checkSubType($type, $id)
{
    if($id !== null){
        return response()->json([
            'valid' => true
        ]);
    }else{
        $sector = \App\Models\ContractSubtype::where('type', $type)->first();
        if ($sector) {
            return response()->json([
                'valid' => false
            ]);
        } else {
            return response()->json([
                'valid' => true
            ]);
        }
    }
}
function checkSubTypeName($name, $id)
{
    if($id !== null){
        return response()->json([
            'valid' => true
        ]);
    }else{
        $sector = \App\Models\ContractSubtype::where('name', $name)->first();
        if ($sector) {
            return response()->json([
                'valid' => false
            ]);
        } else {
            return response()->json([
                'valid' => true
            ]);
        }
    }
}
function checkAbbreviation($abbr, $id){
    if($id !== null){
        return response()->json([
            'valid' => true
        ]);
    }else{
        $user = Institution::where('abbreviation', $abbr)->first();
        if ($user) {
            return response()->json([
                'valid' => false
            ]);
        } else {
            return response()->json([
                'valid' => true
            ]);
        }
    }
}


