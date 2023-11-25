<?php

namespace App\Services;

use App\Repositories\ContractNoticeRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContractNoticeService
{
    /**
     * @var string
     */
    protected string $contract_notices_dir = "public/contractss/notice";
    public function __construct(
        protected ContractNoticeRepository $noticeRepository,
        protected AttachmentService $attachmentService,
        protected ContractService $contractService
    ){}

    /**
     * creating new contract notice
     * @param array $input new contract notice input details to create
     * @return Model
     * @throws Throwable
     */
    public function createContractNotice(array $input) : Model
    {
        $contract = $this->contractService->getContract($input['contract_id']);
        DB::beginTransaction();
        try{
            $notice = $this->noticeRepository->createWithRelation($input, $contract, 'contractNotices');
            $this->attachmentService->createAttachment($notice, $input, $this->contract_notices_dir, 'attachments');
        }
        catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $notice;
    }

    /**
     * creating new contract notice
     * @param Model $contract
     * @param array $input new contract notice input details to create
     * @return Model
     * @throws Throwable
     */
    public function addContractNotice(Model $contract, array $input) : Model
    {
        DB::beginTransaction();
        try{
            $notice = $this->noticeRepository->createWithRelation($input, $contract, 'contractNotices');
        }
        catch (Exception $e){
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $notice;
    }

    /**
     * Update contract notice details
     * @param array $input new contract notice input details to be edited from user
     * @param int $id The given id of a contract notice object needed to be updated
     * @return Model
     * @throws Throwable
     */
    public function updatedContractNotice(array $input, int $id) : Model
    {
        return DB::transaction(function() use ($input, $id) {
            $notice=$this->noticeRepository->update($input,$id);
            $this->attachmentService->updateAttachment($notice, $input, $this->contract_notices_dir, 'attachments');
            return $notice;
        });
    }

    /**
     * Delete contract notice from the database
     * @param int $id The given id of a contract notice
     * @throws Exception
     * @throws Throwable
     */
    public function deleteContractNotice(int $id)
    {
        return DB::transaction(function() use ($id) {
            return $this->noticeRepository->delete($id);
        });
    }

    /**
     * Fetch a specific contract notice given its id
     * @param int $id The given id of a contract notice
     * @return Model|null a contract notice instance of a model
     */
    public function getContractNotice(int $id) : Model|null
    {
        return $this->noticeRepository->find($id);
    }

    /**
     * Fetch list of all contractss notice in database
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator paginated results
     */
    public function findAll() : \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->noticeRepository->paginate(10);
    }
}
