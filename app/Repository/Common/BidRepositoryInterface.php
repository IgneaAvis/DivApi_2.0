<?php

namespace App\Repository\Common;

interface BidRepositoryInterface
{
    public function getBids(int $status = null, string $date = null);
}
