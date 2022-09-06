<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BidsCollectionResource;
use App\Repository\BidsRepository;
use App\Services\BidsService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BidsController extends BaseController
{
    public $bidsRepository;
    public $bidsService;

    public function __construct(BidsRepository $bidsRepository, BidsService $bidsService)
    {
        $this->bidsRepository = $bidsRepository;
        $this->bidsService = $bidsService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/requests",
     *     summary="Получение контента страницы",
     *     tags={"Заявки"},
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          name="status",
     *          description="Active = 0, Resolved = 1",
     *          in="query",
     *          example="1"
     *     ),
     *     @OA\Parameter(
     *          name="order",
     *          description="Date in format like 2022-09-06",
     *          in="query",
     *          example="2022-09-06"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="wrong data"
     *     )
     * )
     *
     */

    public function index(Request $request)
    {
        return new BidsCollectionResource($this->bidsRepository->getBids(
            $request->get('status'),
            $request->get('date')
        ));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/requests",
     *     summary="Создание заявки",
     *     tags={"Заявки"},
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          in="query",
     *          name="name",
     *          description="Имя пользователя",
     *          example="User"
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="email",
     *          description="Email пользователя",
     *          example="test@email.com"
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="message",
     *          description="Сообщение пользователя",
     *          example="Test message"
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="successful operation"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Invalid data"
     *     )
     * )
     */

    public function createBid(Request $request)
    {
        return response()->json($this->bidsService->createBid(
            $request->all()
        ));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/requests/{id}",
     *     summary="Добавление ответа к заявке",
     *     tags={"Заявки"},
     *     security={{"bearer_token":{}}},
     *     @OA\Parameter(
     *          in="path",
     *          name="id",
     *          description="Id заявки",
     *          example=1
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="comment",
     *          description="Комментарий к заявке",
     *          example="Test Comment"
     *     ),
     *     @OA\Response(
     *          response=201,
     *          description="successful operation"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Invalid data"
     *     )
     * )
     */

    public function updateBid(Request $request, $id)
    {
        return response()->json($this->bidsService->updateBid(
            $request->all(),
            $id
        ));
    }

}
