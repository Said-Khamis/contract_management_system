<?php

use App\Models\InternalProcedure;
use App\Models\ProcedureComment;

function canSubmitProcedure($procedurable_type, $procedurable_id)
{
    // has comments
    $procedurable = ['procedurable_type' => $procedurable_type, 'procedurable_id' => $procedurable_id];
    
    $hasComments = ProcedureComment::join('internal_procedures as ip', 'procedure_comments.internal_procedure_id', '=', 'ip.id')->where($procedurable)->exists();

    if(!$hasComments){
        $createdByMe = InternalProcedure::where($procedurable)->where('created_by', auth()->user()->id)->exists();
        if($createdByMe){
            return true;
        }else{
            return false;
        }
    }

    // sent to me
    $isSentToMe = ProcedureComment::
    join('internal_procedures as ip', 'procedure_comments.internal_procedure_id', '=', 'ip.id')
        ->where($procedurable)
        ->where(['to_user_id' => auth()->user()->id])
        ->orderBy('ip.created_at', 'desc')
        ->exists();

    return $isSentToMe;
}