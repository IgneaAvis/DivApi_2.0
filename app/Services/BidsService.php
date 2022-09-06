<?php

namespace App\Services;

use App\Models\Bid;
use App\Services\Common\BidsServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
            return response()->json($validator->messages(), 400);
        }
        $newBid = Bid::create($validator->validated());
        return Bid::all()->last();
    }

    public function updateBid(array $item, int $id)
    {
        $model = Bid::find($id);
        $validator = Validator::make($item, [
            'comment' => ['required', 'max:100']
        ]);
        if ($validator->failed()) {
            return response()->json($validator->messages(), 400);
        }
        $comment = $validator->validated();
        $date = date('Y-m-d h:i:s');
        $model->update([
            'comment' => $comment['comment'],
            'updated_at' => $date,
            'status' => 'Resolved'
        ]);
        return $model;
    }
}
