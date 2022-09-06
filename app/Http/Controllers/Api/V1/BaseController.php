<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\Swagger(
 *      schemes={"http"},
 *      host="localhost",
 *      basePath="/api/v1/",
 *      @OA\Info(
 *          title="DivApi_2",
 *          version="1.0.0"
 *      ),
 *      @OA\SecurityScheme(
 *          type="http",
 *          in="header",
 *          scheme="bearer",
 *          securityScheme="bearer_token"
 *      )
 * )
 */

class BaseController extends Controller
{
    //
}
