<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Service;
use App\Models\User;
use App\Models\WorkHour;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Statement;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usamos truncate para limpar as tabelas e reiniciar os IDs. (PostgreSQL)
        DB::statement('TRUNCATE TABLE users, services, work_hours, appointments RESTART IDENTITY CASCADE');

        // Criar um profissional específico para testes
        $professional = User::factory()->professional()->create([
            'name' => 'Dr. Barber',
            'email' => 'professional@gmail.com'
        ]);
        echo "Profissional criado: professional@gmail.com | password\n";

        // Definir horários de trabalho desse profissional (Seg a Sex, 9h -18h)
        for ($i = 1; $i <= 5; $i++) {
            WorkHour::create([
                'user_id' => $professional->id,
                'day_of_week' => $i,
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ]);
        }
        echo "Horários de trabalho do profissional definidos.\n";

        // Criar alguns serviços genéricos
        Service::factory()->create(['name' => 'Corte simples', 'duration_minutes' => 30, 'price' => 50.00]);
        Service::factory()->create(['name' => 'Corte + Barba', 'duration_minutes' => 60, 'price' => 90.00]);
        Service::factory()->create(['name' => 'Hidratação', 'duration_minutes' => 45, 'price' => 75.00]);
        echo "Serviços criados.\n";

        // Criar 10 clientes aleatórios
        User::factory()->count(10)->create();
        echo "10 clientes aleatórios criados.\n";
    }
}
