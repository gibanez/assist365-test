<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Reservation\MakeReservationService;
use Illuminate\Http\Request;

class ReservationStoreController extends Controller
{
    /**
     * @var MakeReservationService
     */
    private $makeReservationService;

    public function __construct(MakeReservationService $makeReservationService)
    {
        $this->makeReservationService = $makeReservationService;
    }

    /**
     * @OA\Post(
     *     path="/api/reservations",
     *     summary="Crear nueva reserva",
     *     description="Crea una nueva reserva con estado inicial PENDING y pasajeros asociados.",
     *     tags={"Reservations"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos para crear la reserva",
     *         @OA\JsonContent(
     *             type="object",
     *             required={"flight_number","departure_time","passengers"},
     *             @OA\Property(property="flight_number", type="string", example="AR1234"),
     *             @OA\Property(property="departure_time", type="string", format="date-time", example="2025-10-15 14:30:00"),
     *             @OA\Property(
     *                 property="passengers",
     *                 type="array",
     *                 description="IDs de pasajeros existentes asociados a la reserva",
     *                 @OA\Items(type="integer", example=1)
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Reserva creada con éxito",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Reservation created successfully"),
     *             @OA\Property(property="reservation", type="object",
     *                 @OA\Property(property="id", type="string", example="abc123"),
     *                 @OA\Property(property="flight_number", type="string", example="AR1234"),
     *                 @OA\Property(property="departure_time", type="string", format="date-time", example="2025-10-15 14:30:00"),
     *                 @OA\Property(property="status", type="string", example="PENDING"),
     *                 @OA\Property(
     *                     property="passengers",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="name", type="string", example="Juan Pérez"),
     *                         @OA\Property(property="document", type="string", example="DNI 12345678")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Solicitud inválida (faltan datos requeridos)"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor"
     *     )
     * )
     */
    public function __invoke(Request $request)
    {
        try {
            $reservation = $this->makeReservationService->execute($request->toArray());
            return response()->json([
                'message' => 'Reservation created successfully',
                'reservation' => $reservation->load('passengers')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating reservation',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
