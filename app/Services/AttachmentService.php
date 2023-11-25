<?php

namespace App\Services;

use App\Exceptions\FileException;
use App\Models\Attachment;
use App\Repositories\AttachmentRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AttachmentService
{
    /**
     * Define the file input names associated with file types to be stored as attachments
     * @var array
     */
    protected array $fileType = [
        'letter_of_intent',
        'note_verbal',
        'passport_copy',
        'agreement',
        'instrument_of_ratification',
    ];

    public function __construct(protected AttachmentRepository $attachmentRepository){}

    /**
     * creating new attachment
     *
     * @param Model $model
     * @param array $inputs
     * @param string $directory
     * @param string $relationship
     * @param string|null $prefix
     *
     * @return Model|null
     * @throws FileException
     * @throws Throwable
     */
    public function createAttachment(Model $model, array $inputs, string $directory, string $relationship, string $prefix = null) : ?Model
    {
        DB::beginTransaction();
        try {
            $attachment = null; // Initialize $attachment to null
            if(isset($inputs['attachment_files']))
            {
                foreach ($inputs['attachment_files'] as $key => $file)
                {
                    if(!is_file($file)){
                        throw new FileException("Attachment file could not be found");
                    }
                    $originalName = $file->getClientOriginalName();
                    $filename = time().'.'.$originalName;
                    $file->move($directory,$filename);
                    $url = $directory . '/' . $filename;
                    $name = $inputs['attachment_type'][$key];

                    $attachmentInput = $this->setAttachmentInputs($name, $url);
                    $attachment = $this->attachmentRepository->createWithRelation($attachmentInput, $model, $relationship);
                }
            }
        } catch (Exception $e)
        {
            DB::rollBack();
            report($e);
            throw $e;
        }
        DB::commit();
        return $attachment;
    }

    public function setAttachmentInputs($name,$url): array
    {
        return ['name' => $name, 'url' => $url];
    }

    /**
     * Update attachment details
     * @param Model $model
     * @param array $inputs
     * @param string $directory
     * @param string $relationship
     * @param string|null $prefix
     * @return Model|null
     * @throws Throwable
     */
    public function updateAttachment(Model $model, array $inputs, string $directory, string $relationship, string $prefix = null): Model|null
    {
        return DB::transaction(function () use ($model,$inputs, $directory,$relationship){
            foreach ($inputs['attachment_id'] as $key=>$item)
            {
                if (isset($inputs['attachment_files'][$key])) {
//                    $unlinkPrevious=$this->attachmentRepository->find($item);
//                    if(file_exists($unlinkPrevious?->url))
//                    {
//                        unlink($unlinkPrevious?->url);
//                    }
                    $file = $inputs['attachment_files'][$key];
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file_url = $directory .'/'. $filename;
                    $file->storeAs($directory, $filename);

                    $attachmentInput = [
                        'url' => $file_url,
                    ];
                    $this->attachmentRepository->update($attachmentInput, $item);
                }
            }
        });

    }

     /**
     * delete a attachment from a database attachment table
     * @throws Exception|Throwable
      */
    public function deleteAttachment(string|int $id)
    {
        return DB::transaction(function () use ($id){
            return $this->attachmentRepository->delete(decode($id));
           });
    }

    /**
     * fetch one  attachment by its id
     * @param string|int $id id of primary key of a single attachment
     * @return Model|Collection|Builder|array|null a attachment instance of a model
     */
    public function getAttachment(string|int $id): Model|Collection|Builder|array|null{
        return $this->attachmentRepository->find(decode($id));
    }
     /**
     * Fetch list of all attachments in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll(): LengthAwarePaginator{
        return $this->attachmentRepository->paginate(10);
    }

    public function createSingleAttachment(array $input): Attachment
    {
        $file = $input['file'];
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('action_plan', $fileName, 'public');
        $file_url = 'public/contractss/' . $fileName;
        $data = [
            "attachable_id" => $input['attachable_id'],
            "attachable_type" => "App\Models\ActionPlan",
            "file_path" => $filePath,
            "name" => $fileName,
            "url" =>$file_url
        ];
        $attachment = new Attachment($data);
        $attachment->save();
        return $attachment;

    }
}
