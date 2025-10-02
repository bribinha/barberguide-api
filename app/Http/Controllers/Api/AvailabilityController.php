<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AvailabilityController extends Controller
{
    public function show(Request $request, User $professional)
    {
        // Validação de dados de entrada
        $validator = Validator::make($request->all(), [
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $date = Carbon::parse($request->input('date'));

        // Checar se o usuário é mesmo um profissional
        if ($professional->role !== 'professional') {
            return response()->json(['error' => 'O usuário selecionado não é um profissional'], 404);
        }

        // Buscar os horário de trabalho do profissional para aquele dia da semana
        $dayOfWeek = $date->dayOfWeek;
        $workHour = $professional->workHours()->where('day_of_week', $dayOfWeek)->first();

        if (!$workHour) {
            return response()->json(['available_times' => []]);
        }

        // Buscar os agendamentos já existentes para o profissional no dia
        $appointments = $professional->professionalAppointments()
            ->whereDate('start_time', $date->toDateString())
            ->get();

        // Gerar todos os slots de horários possíveis do dia
        $slotInterval = 30; // Intervalo de 30 minutos por slot
        $startTime = $date->copy()->setTimeFromTimeString($workHour->start_time);
        $endTime = $date->copy()->setTimeFromTimeString($workHour->end_time);

        $possibleSlots = CarbonPeriod::create($startTime, "{$slotInterval} minutes", $endTime);

        $availableTimes = [];
        foreach ($possibleSlots as $slot) {
            // Ignorar o último slot se ele for igual ao horário de fim de expediente
            if ($slot->format('H:i:s') == $endTime->format('H:i:s')) {
                continue;
            }

            $isAvailable = true;
            // Verificar se o slot atual conflita com algum agendamento existente
            foreach ($appointments as $appointment) {
                $appointmentStart = Carbon::parse($appointment->start_time);
                $appointmentEnd = Carbon::parse($appointment->end_time);

                // gte (maior ou igual) e lt (menor que)
                if ($slot->gte($appointmentStart) && $slot->lt($appointmentEnd)) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $availableTimes[] = $slot->format('H:i:s');
            }
        }

        return response()->json(['available_times' => $availableTimes]);
    }
}
