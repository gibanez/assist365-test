<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Passenger\PassengerFinderService;
use Illuminate\Http\Request;

class PassengerShowController extends Controller
{

    /**
     * @var PassengerFinderService
     */
    private $passengerFinderService;

    public function __construct(PassengerFinderService $passengerFinderService)
    {
        $this->passengerFinderService = $passengerFinderService;
    }
    /**
     * @OA\Get(
     *     path="/api/passengers/{id}",
     *     summary="Obtener pasajero por ID",
     *     tags={"Passengers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del pasajero",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pasajero encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="string", example="123"),
     *             @OA\Property(property="name", type="string", example="Juan Pérez"),
     *             @OA\Property(property="document", type="string", example="DNI 12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pasajero no encontrado"
     *     )
     * )
     */
    public function __invoke(Request $request, string $id)
    {
        return $this->success($this->passengerFinderService->getById($id));
    }
}
