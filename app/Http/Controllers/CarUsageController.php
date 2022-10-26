<?php

namespace App\Http\Controllers;

use App\Services\CarUsageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;
use Validator;

class CarUsageController extends Controller
{
    private CarUsageService $carUsageService;

    public function __construct(
        CarUsageService $carUsageService
    )
    {
        $this->carUsageService = $carUsageService;
    }

    /**
     * @return Response
     */

    /**
     * @OA\Get(
     * path="/api/car-usage/list",
     * summary="Get car usage list",
     * @OA\Response(
     *    response=200,
     *    description="Successful response",
     *    @OA\JsonContent(
     *       @OA\Property(property="userId", type="int", example=1),
     *       @OA\Property(property="userName", type="String", example="Kiley Gerlach DDS"),
     *       @OA\Property(property="carId", type="int", example=1),
     *       @OA\Property(property="carName", type="string", example="yh947yI")
     *        )
     *     )
     * )
     */
    public function getCarUsageList(): Response
    {
        try {
            $list = $this->carUsageService->getCarUsageList();
            return new Response($list, 200);
        } catch (Exception $exception) {
            return new Response(
                $exception->getMessage(),
                500
            );
        }
    }

    /**
     * @param Request $request
     * @return Response
     */

    /**
     * @OA\Put(
     * path="/api/car-usage/set",
     * summary="set carId to user",
     * @OA\RequestBody(
     *  @OA\JsonContent(
     *     type="object",
     *     @OA\Property(property="userId", type="integer", example=1),
     *     @OA\Property(property="carId", type="integer", example=1),
     * ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successful response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Car ID successfully set"),
     *        )
     *     ),
     * @OA\Response(
     *    response=400,
     *    description="Bad Request response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Bad Request"),
     *        )
     *     ),
     * @OA\Response(
     *    response=500,
     *    description="Internal Server Error",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Internal Server Error"),
     *        )
     *     )
     * )
     */

    public function setCarIdToUser(Request $request): Response
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'userId' => 'required|integer',
            'carId' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return new Response(['message' => 'Bad Request'], 400);
        }
        try {
            $this->carUsageService->setCarIdToUser($data['userId'], $data['carId']);
            return new Response(
                ['message' => 'Car ID successfully set'],
                200
            );
        } catch (Exception $exception) {
            return new Response(
                $exception->getMessage(),
                500
            );
        }
    }

    /**
     * @param Request $request
     * @return Response
     */

    /**
     * @OA\Put(
     * path="/api/car-usage/remove",
     * summary="remove carId from User",
     * @OA\RequestBody(
     *  @OA\JsonContent(
     *     type="object",
     *     @OA\Property(property="userId", type="integer", example=1),
     * ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Successful response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Car ID successfully removed"),
     *        )
     *     ),
     * @OA\Response(
     *    response=400,
     *    description="Bad Request response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Bad Request"),
     *        )
     *     ),
     * @OA\Response(
     *    response=500,
     *    description="Internal Server Error",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Internal Server Error"),
     *        )
     *     )
     * )
     */
    public function removeCarIdFromUser(Request $request): Response
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'userId' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return new Response('Bad Request', 400);
        }
        try {
            $this->carUsageService->removeCarIdFromUser($data['userId']);
            return new Response(
                'Car ID successfully removed',
                200
            );
        } catch (Exception $exception) {
            return new Response(
                $exception->getMessage(),
                500
            );
        }
    }
}
