<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    public function index(): JsonResponse
    {
        $appointments = Appointment::all();
        return response()->json($appointments);
    }

    public function store(StoreAppointmentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // 1 - Calcular a end_time
        $service = Service::find($validated['service_id']);
        $startTime = Carbon::parse($validated['start_time']);
        $endTime = $startTime->copy()->addMinutes($service->duration_minutes);

        // 2- Re-checar a disponibilidade (defesa contra condição de corrida)
        $conflictingAppointment = Appointment::where('professional_id', $validated['professional_id'])
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '>=', $startTime)
                    ->where('start_time', '<', $endTime);
            })->orWhere(function ($q) use ($startTime, $endTime) {
                $q->where('end_time', '>', $startTime)
                    ->where('end_time', '<=', $endTime);
            })
            ->exists();

        if ($conflictingAppointment) {
            return response()->json(['error' => 'O horário selecionado não está mais disponível'], 409); // 409 conflict
        }

        // Criar o agendamento
        $appointment = Appointment::create([
            'client_id' => $validated['client_id'],
            'professional_id' => $validated['professional_id'],
            'service_id' => $validated['service_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return response()->json($appointment, 201);
    }
}
