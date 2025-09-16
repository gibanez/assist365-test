<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Reservation\ReservationFinderService;
use Illuminate\Http\Request;

class ReservationListController extends Controller
{
    /**
     * @var ReservationFinderService
     */
    private $reservationFinderService;

    public function __construct(ReservationFinderService $reservationFinderService)
    {
        $this->reservationFinderService = $reservationFinderService;
    }

    /**
     * @OA\Get(
     *     path="/api/reservations",
     *     summary="Listar reservas",
     *     description="Devuelve una lista de reservas aplicando filtros por departure_time y status, con ordenamiento y paginación.",
     *     tags={"Reservations"},
     *
     *     @OA\Parameter(
     *         name="filter[0][field]",
     *         in="query",
     *         required=true,
     *         description="Campo a filtrar (ejemplo: departure_time)",
     *         @OA\Schema(type="string", example="departure_time")
     *     ),
     *     @OA\Parameter(
     *         name="filter[0][condition]",
     *         in="query",
     *         required=true,
     *         description="Condición de filtro (ej: eq)",
     *         @OA\Schema(type="string", example="eq")
     *     ),
     *     @OA\Parameter(
     *         name="filter[0][value]",
     *         in="query",
     *         required=true,
     *         description="Valor del filtro de departure_time",
     *         @OA\Schema(type="string", format="date-time", example="2025-10-15 14:30:00")
     *     ),
     *
     *     @OA\Parameter(
     *         name="filter[1][field]",
     *         in="query",
     *         required=true,
     *         description="Campo a filtrar (ejemplo: status)",
     *         @OA\Schema(type="string", example="status")
     *     ),
     *     @OA\Parameter(
     *         name="filter[1][condition]",
     *         in="query",
     *         required=true,
     *         description="Condición de filtro (ej: in)",
     *         @OA\Schema(type="string", example="in")
     *     ),
     *     @OA\Parameter(
     *         name="filter[1][value]",
     *         in="query",
     *         required=true,
     *         description="Valor del filtro de status",
     *         @OA\Schema(type="string", example="CONFIRMED")
     *     ),
     *
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         required=false,
     *         description="Ordenamiento por campos (ej: -departure_time,status)",
     *         @OA\Schema(type="string", example="-departure_time,status")
     *     ),
     *     @OA\Parameter(
     *         name="page[offset]",
     *         in="query",
     *         description="Offset de paginación",
     *         required=false,
     *         @OA\Schema(type="integer", example=0)
     *     ),
     *     @OA\Parameter(
     *         name="page[limit]",
     *         in="query",
     *         description="Cantidad de resultados por página",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Listado de reservas",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="jsonapi", type="object",
     *                 @OA\Property(property="version", type="string", example="1.0")
     *             ),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="string", example="abc123"),
     *                     @OA\Property(property="flight_number", type="string", example="AR1234"),
     *                     @OA\Property(property="departure_time", type="string", format="date-time", example="2025-10-15 14:30:00"),
     *                     @OA\Property(property="status", type="string", example="CONFIRMED")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function __invoke(Request $request)
    {
        $reservations = $this->reservationFinderService->matchByRequest($request);
        return $this->success($reservations);
    }
}
