<?php

namespace App\Services;

use App\Mail\UpdateMessage;
use App\Models\Bid;
use App\Services\Common\BidsServiceInterface;
use App\Services\Common\ServiceResult;
use Illuminate\Support\Facades\Validator;
use Mail;

class BidsService implements BidsServiceInterface
{

    public function createBid(array $items)
    {
        $validator = Validator::make($items, [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required', 'max:10000']
        ]);
        if ($validator->failed()) {
            return ServiceResult::createErrorResult('Validation Error', $validator->errors()->toArray());
        }
        $newBid = Bid::create($validator->validated());
        return ServiceResult::createSuccessResult($newBid);
    }

    public function updateBid(array $item, int $id)
    {
        $model = Bid::find($id);
        $validator = Validator::make($item, [
            'comment' => ['required', 'max:100']
        ]);
        if ($validator->failed()) {
            return ServiceResult::createErrorResult('Validation Error', $validator->errors()->toArray());
        }
        $comment = $validator->validated();
        $model->update([
            'comment' => $comment['comment'],
            'status' => 1
        ]);
        $this->send_mail($model);
        return ServiceResult::createSuccessResult($model);
    }

    public function send_mail($model){
        $name = $model->get('name');
        $comment = $model->get('comment');
        $msg = $model->get('message');
        $items = [$name, $msg, $comment];
        Mail::to($model->get('email'))->send(new UpdateMessage($items));
    }
}
