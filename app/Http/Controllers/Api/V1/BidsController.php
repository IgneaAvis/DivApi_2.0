<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BidsCollectionResource;
use App\Repository\BidsRepository;
use App\Services\BidsService;
use Illuminate\Http\Request;

class BidsController extends BaseController
{
    public $bidsRepository;
    public $bidsService;

    public function __construct(BidsRepository $bidsRepository, BidsService $bidsService)
    {
        $this->bidsRepository = $bidsRepository;
        $this->bidsService = $bidsService;
    }

    public function index(Request $request)
    {
        return new BidsCollectionResource($this->bidsRepository->getBids(
            $request->get('status'),
            $request->get('order'))
        );
    }

    public function createBid(Request $request)
    {
        return $this->bidsService->createBid(
            $request->all()
        );
    }

    public function updateBid(Request $request, $id)
    {
        return $this->bidsService->updateBid(
            $request->all(),
            $id
        );
    }

}
