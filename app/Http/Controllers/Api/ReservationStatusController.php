<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Reservation\ChangeStatusService;
use App\Services\Reservation\ReservationStatus;
use Illuminate\Http\Request;

class ReservationStatusController extends Controller
{
    /**
     * @var ChangeStatusService
     */
    private $changeStatusService;

    public function __construct(ChangeStatusService $changeStatusService)
    {
        $this->changeStatusService = $changeStatusService;
    }

    /**
     * @OA\Patch(
     *     path="/api/reservations/{id}/status",
     *     summary="Cambiar estado de una reserva",
     *     description="Permite actualizar el estado de una reserva existente.",
     *     tags={"Reservations"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la reserva",
     *         @OA\Schema(type="string", example="abc123")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="Nuevo estado de la reserva",
     *         @OA\JsonContent(
     *             type="object",
     *             required={"status"},
     *             @OA\Property(property="status", type="string", example="CONFIRMED")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Estado actualizado con éxito",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="jsonapi", type="object",
     *                 @OA\Property(property="version", type="string", example="1.0")
     *             ),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="success", type="boolean", example=true)
     *             ),
     *             @OA\Property(property="meta", type="object",
     *                 @OA\Property(property="message", type="string", example="Change status: OK")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Solicitud inválida (estado no permitido)"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Reserva no encontrada"
     *     )
     * )
     */
    public function __invoke(Request $request, string $id)
    {
        $data = $request->toArray();
        $status = ReservationStatus::factory($data['status']);
        $this->changeStatusService->execute($id, $status);
        return $this->success(['success' => true], ['message' => 'Change status: OK']);
    }
}
