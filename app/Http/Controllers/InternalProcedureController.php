<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Models\ProcedureComment;
use App\Models\InternalProcedure;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\InternalProcedureService;
use App\Http\Controllers\AppBaseController;

class InternalProcedureController extends AppBaseController
{

    public function __construct(protected InternalProcedureService $internalProcedureService){}


    public function createForContract(Request $request, $contract_id)
    {
        $contract = Contract::find(decode($contract_id));
        if (empty($contract)) {
            Alert::error('Page not found');
            return redirect()->back();
        }

        if ($request->isMethod('post')) {

            if(($request->to_institution_id && $request->user_id) || (is_null($request->to_institution_id) && is_null($request->user_id))){
                Alert::error('Failed! Please select Staff or Institution');
                return redirect()->back();
            }

            if(!$request->comment){
                Alert::error('Failed! Comment can not be empty');
                return redirect()->back();
            }

            if ($request->hasFile('attachment_file')){
                $directory = 'public/contractss/procedures/';
                // $directory = 'uploads';
                if (!Storage::exists($directory)) {
                    Storage::makeDirectory($directory);
                }
                $file = $request->file('attachment_file');
                $path = Storage::putFile($directory, $file);
                if (empty($path)) {
                    throw new \Exception("Something went wrong on Attachment, please try again.");
                }
            }

            if($request->user_id && is_null($request->to_institution_id)){

                $internalProcedure = InternalProcedure::where([
                    'procedurable_type' => Contract::class,
                    'procedurable_id' => $contract->id,
                    'from_institution_id' => auth()->user()->institution_id,
                    'to_institution_id' => $request->to_institution_id
                ])->first();

                if($internalProcedure){
                    $comment['internal_procedure_id'] = $internalProcedure->id;
                    $comment['from_user_id'] = auth()->user()->id;
                    $comment['to_user_id'] = $request->user_id;
                    $comment['comment'] = $request->comment;
                    $comment = ProcedureComment::create($comment);


                    if (!empty($path)) {
                        $attachment['name'] = $request->get('attachment_name');
                        $attachment['url'] = $path;
                        $attachment['created_by'] = auth()->user()->id;
                        $comment->attachment()->save(new Attachment($attachment));
                    }

                }

                Alert::toast('Comment submited successfully.');
                return redirect()->back();
            }

            if($request->to_institution_id && is_null($request->user_id)){

                $procedure['from_institution_id'] = auth()->user()->institution_id;
                $procedure['to_institution_id'] = $request->to_institution_id;
                $procedure['status'] = 1;
                $contract->internalProcedure()->save($internalProcedure = new InternalProcedure($procedure));

                $comment['internal_procedure_id'] = $internalProcedure->id;
                $comment['from_user_id'] = auth()->user()->id;
                $comment['to_user_id'] = null;
                $comment['comment'] = $request->comment;
                $comment = ProcedureComment::create($comment);


                if (!empty($path)) {
                    $attachment['name'] = $request->get('attachment_name');
                    $attachment['url'] = $path;
                    $attachment['created_by'] = auth()->user()->id;
                    $comment->attachment()->save(new Attachment($attachment));
                }

                Alert::toast('Submited to Institution successfully.');
                return redirect()->back();
            }

            Alert::error('Failed! Something went wrong');
            if (isset($path)) {
                Storage::delete($path);
            }
            return redirect()->back();
        }

        $procedures = InternalProcedure::with('toInstitution', 'fromInstitution')
          ->where(['procedurable_id' => $contract->id, 'procedurable_type' => Contract::class])
          ->orderBy('created_at', 'desc')
          ->get();

        return view('internal_procedures.create', compact('contract', 'procedures'));
    }

}
