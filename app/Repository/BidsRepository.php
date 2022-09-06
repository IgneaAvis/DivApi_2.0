<?php

namespace App\Repository;

use App\Models\Bid;
use App\Repository\Common\BidRepositoryInterface;

class BidsRepository implements BidRepositoryInterface
{
    public function getBids(int $status = null, string $date = null)
    {
        $qb = Bid::select();
        if (!is_null($status)) {
            $qb->where('status', '=', $status);
        }
        if (!is_null($date)) {
            $qb->whereDate('created_at', $date);
        }
        return $qb->get();
    }
}
