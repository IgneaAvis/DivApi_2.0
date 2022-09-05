<?php

namespace App\Repository\Common;

interface BidRepositoryInterface
{
    public function getBids(string $status = null, string $order = 'null');
}
