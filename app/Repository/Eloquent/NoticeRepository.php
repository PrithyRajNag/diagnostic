<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Notice;
use App\Repository\NoticeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class NoticeRepository extends BaseRepository implements NoticeRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Notice $model)
    {
        $this->model = $model;
    }
    public function createNotice($payload){
        $notice = new Notice();
        $notice->title = $payload->title;
        $notice->description = $payload->description;
        $notice->start_date =$payload->start_date;
        $notice->end_date =$payload->end_date;
        $notice->status =$payload->status;

        if($payload->hasFile('document')) {
            $fileName = time() . '.' . $payload->file('document')->extension();
            $payload->file('document')->storeAs('public/documents', $fileName, 'local');
            $notice->document = $fileName;
        }

        $notice->save();
    }
    public function updateNotice($uuid, $payload)
    {

        $item = $this->findByUuid($uuid);
        $document = $item->document;

        if($payload->hasFile('document'))
        {
            Storage::delete('public/documents/'.$document );

            $fileName = time().'.'.$payload->file('document')->extension();
            $payload->file('document')->storeAs('public/documents',$fileName, 'local');
            $item->document = $fileName;
        }


        $item->title = $payload->title;
        $item->description = $payload->description;
        $item->start_date = $payload->start_date;
        $item->end_date = $payload->end_date;
        $item->status = $payload->status;

        $item->save();

        return $item;

    }
}
