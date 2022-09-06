<?php

namespace App\Repository;

use App\Models\Bid;
use App\Repository\Common\BidRepositoryInterface;

class BidsRepository implements BidRepositoryInterface
{
    public function getBids(string $status = null, string $order = null)
    {
        if (!is_null($status) && is_null($order)) {
            return Bid::select()->where('status', '=', $status)->get();
        }
        if (is_null($status) && !is_null($order)) {
            return Bid::select()->orderBy('id', $order)->get();
        }
        if(!is_null($status) && !is_null($order)){
            return Bid::select()->where('status', '=', $status)->orderBy('id', $order)->get();
        }
        if(is_null($status) && is_null($order)){
            return Bid::all();
        }
        return response()->json(['error' => true, 'message' => 'error'], 400);
    }
}
