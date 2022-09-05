<?php

namespace App\Services\Common;

interface BidsServiceInterface
{
    public function createBid(array $items);
    public function updateBid(array $item, int $id);
}
